<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ImageUploader
{
  // Batas maksimum lebar atau tinggi untuk standar web
  protected int $maxDimension = 1920;
  protected int $quality = 80;

  public function store(UploadedFile $file, string $directory, string $disk = 'public'): string
  {
    if (!extension_loaded('gd') || !function_exists('imagewebp')) {
      throw new RuntimeException('PHP extension GD dengan dukungan WebP wajib diaktifkan.');
    }

    // Gambar resolusi tinggi (foto HP) butuh memori besar
    @ini_set('memory_limit', '1024M');

    $realPath = $file->getRealPath();

    // Baca informasi dimensi tanpa meload gambar ke memori
    [$origWidth, $origHeight, $imageType] = @getimagesize($realPath);

    if (!$origWidth || !$origHeight) {
      throw new RuntimeException('Format file gambar tidak valid atau rusak.');
    }

    // Buat GD image resource berdasarkan tipe file asli dari file path (hemat RAM)
    $source = match ($imageType) {
      IMAGETYPE_JPEG => @imagecreatefromjpeg($realPath),
      IMAGETYPE_PNG => @imagecreatefrompng($realPath),
      IMAGETYPE_WEBP => @imagecreatefromwebp($realPath),
      default => @imagecreatefromstring(file_get_contents($realPath)),
    };

    if ($source === false) {
      throw new RuntimeException('Gagal memproses gambar yang diunggah.');
    }

    // Orientasi EXIF (dibaca dari metadata, tidak menyentuh memori)
    $orientation = $this->readExifOrientation($realPath);

    // Resize dulu selagi gambar masih resolusi penuh -> hasil jadi kecil, hemat memori
    if ($origWidth > $this->maxDimension || $origHeight > $this->maxDimension) {
      $source = $this->resizeDown($source, $origWidth, $origHeight, $this->maxDimension);
    }

    // Rotasi/flip pada gambar KECIL agar foto HP tidak miring
    $source = $this->applyExifOrientation($source, $orientation);

    // Pertahankan transparansi PNG / WebP
    imagepalettetotruecolor($source);
    imagealphablending($source, false);
    imagesavealpha($source, true);

    // Encode ke WebP menggunakan buffer stream sementara
    $stream = fopen('php://temp', 'r+');
    $encoded = imagewebp($source, $stream, $this->quality);
    imagedestroy($source);

    if (!$encoded) {
      fclose($stream);
      throw new RuntimeException('Gambar gagal dikonversi ke format WebP.');
    }

    rewind($stream);

    // Simpan langsung via stream ke storage Laravel
    $path = trim($directory, '/') . '/' . Str::uuid() . '.webp';
    Storage::disk($disk)->put($path, $stream);

    if (is_resource($stream)) {
      fclose($stream);
    }

    return $path;
  }

  private function resizeDown($image, int $width, int $height, int $max): mixed
  {
    if ($width >= $height) {
      $newWidth = $max;
      $newHeight = (int) round(($height / $width) * $max);
    } else {
      $newHeight = $max;
      $newWidth = (int) round(($width / $height) * $max);
    }

    $resized = imagescale($image, $newWidth, $newHeight, IMG_BILINEAR_FIXED);
    imagedestroy($image);

    return $resized ?: $image;
  }

  private function readExifOrientation(string $realPath): int
  {
    if (function_exists('exif_read_data')) {
      $exif = @exif_read_data($realPath);
      return (int) ($exif['Orientation'] ?? 1);
    }

    return $this->readExifOrientationManually($realPath);
  }

  private function applyExifOrientation(mixed $image, int $orientation): mixed
  {
    switch ($orientation) {
      case 3:
        return imagerotate($image, 180, 0);
      case 6:
        return imagerotate($image, -90, 0);
      case 8:
        return imagerotate($image, 90, 0);
      case 2:
        imageflip($image, IMG_FLIP_HORIZONTAL);
        return $image;
      case 4:
        imageflip($image, IMG_FLIP_VERTICAL);
        return $image;
      case 5:
        imageflip($image, IMG_FLIP_HORIZONTAL);
        return imagerotate($image, 90, 0);
      case 7:
        imageflip($image, IMG_FLIP_VERTICAL);
        return imagerotate($image, 90, 0);
      default:
        return $image;
    }
  }

  private function readExifOrientationManually(string $realPath): int
  {
    $fp = @fopen($realPath, 'rb');
    if ($fp === false) {
      return 1;
    }

    $data = fread($fp, 65536);
    fclose($fp);

    if (strlen($data) < 8 || substr($data, 0, 2) !== "\xFF\xD8") {
      return 1;
    }

    $pos = 2;
    $len = strlen($data);

    while ($pos + 4 <= $len) {
      if (substr($data, $pos, 1) !== "\xFF") {
        break;
      }

      $marker = ord($data[$pos + 1]);

      if ($marker === 0xDA) { // SOS -> awal data gambar
        break;
      }

      if ($marker === 0xD8 || ($marker >= 0xD0 && $marker <= 0xD7)) {
        $pos += 2;
        continue;
      }

      if ($pos + 2 > $len) {
        break;
      }

      $segLen = unpack('n', substr($data, $pos + 2, 2))[1];

      if ($marker === 0xE1 && $segLen >= 10) {
        $exif = substr($data, $pos + 4, $segLen - 2);
        if (substr($exif, 0, 6) === "Exif\x00\x00") {
          return $this->parseExifOrientationFromTiff(substr($exif, 6));
        }
      }

      $pos += 2 + $segLen;
    }

    return 1;
  }

  private function parseExifOrientationFromTiff(string $tiff): int
  {
    if (strlen($tiff) < 8) {
      return 1;
    }

    $byteOrder = substr($tiff, 0, 2);
    $little = $byteOrder === 'II';
    $fmtShort = $little ? 'v' : 'n';
    $fmtLong = $little ? 'V' : 'N';

    if (substr($tiff, 2, 2) !== ($little ? "\x2A\x00" : "\x00\x2A")) {
      return 1;
    }

    $ifdOffset = unpack($fmtLong, substr($tiff, 4, 4))[1];
    if ($ifdOffset + 2 > strlen($tiff)) {
      return 1;
    }

    $entries = unpack($fmtShort, substr($tiff, $ifdOffset, 2))[1];

    for ($i = 0; $i < $entries; $i++) {
      $entryPos = $ifdOffset + 2 + $i * 12;
      if ($entryPos + 12 > strlen($tiff)) {
        return 1;
      }

      $tag = unpack($fmtShort, substr($tiff, $entryPos, 2))[1];

      if ($tag === 0x0112) {
        $orientation = unpack($fmtShort, substr($tiff, $entryPos + 8, 2))[1];
        return ($orientation >= 1 && $orientation <= 8) ? $orientation : 1;
      }
    }

    return 1;
  }
}