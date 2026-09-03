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

    // Coba naikkan memori sementara (tidak error meski di-disable oleh hosting)
    // @ini_set('memory_limit', '256M');

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

    // Resize proporsional jika dimensi gambar melebihi batas web
    if ($origWidth > $this->maxDimension || $origHeight > $this->maxDimension) {
      $source = $this->resizeDown($source, $origWidth, $origHeight, $this->maxDimension);
    }

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
}