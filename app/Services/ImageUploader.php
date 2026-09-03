<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ImageUploader
{
  public function store(UploadedFile $file, string $directory, string $disk = 'public'): string
  {
    if (!function_exists('imagecreatefromstring') || !function_exists('imagewebp')) {
      throw new RuntimeException('PHP extension GD dengan dukungan WebP wajib diaktifkan untuk upload gambar.');
    }

    $image = imagecreatefromstring($file->get());

    if ($image === false) {
      throw new RuntimeException('Gambar yang diunggah tidak dapat diproses.');
    }

    imagepalettetotruecolor($image);
    imagealphablending($image, false);
    imagesavealpha($image, true);

    ob_start();
    $encoded = imagewebp($image, null, 85);
    $contents = ob_get_clean();
    imagedestroy($image);

    if (!$encoded || $contents === false) {
      throw new RuntimeException('Gambar gagal dikonversi ke WebP.');
    }

    $path = trim($directory, '/') . '/' . Str::uuid() . '.webp';
    Storage::disk($disk)->put($path, $contents);

    return $path;
  }
}