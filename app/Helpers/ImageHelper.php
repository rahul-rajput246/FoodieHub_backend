<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class ImageHelper
{
    /**
     * Store uploaded image both on disk AND as an optimized WebP data URI.
     * This guarantees the image works on ephemeral hosting (Render free tier),
     * across different environments (local vs live), and survives container restarts.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param int $maxWidth
     * @param int $quality
     * @return string
     */
    public static function processUploadedImage(UploadedFile $file, string $directory = 'uploads', int $maxWidth = 1400, int $quality = 78): string
    {
        // 1. Try to store on disk for local serving
        try {
            $file->store($directory, 'public');
        } catch (\Throwable $e) {
            // Ignore if filesystem is read-only
        }

        // 2. Compress and generate a lightweight WebP data URI for persistent DB storage
        try {
            $realPath = $file->getRealPath();
            if ($realPath && file_exists($realPath) && function_exists('imagecreatefromstring')) {
                $imageContent = file_get_contents($realPath);
                $gd = @imagecreatefromstring($imageContent);
                if ($gd) {
                    $width = imagesx($gd);
                    $height = imagesy($gd);

                    // Resize if larger than maxWidth while maintaining aspect ratio
                    if ($width > $maxWidth) {
                        $newWidth = $maxWidth;
                        $newHeight = (int) round(($height / $width) * $newWidth);
                        $resized = imagecreatetruecolor($newWidth, $newHeight);
                        imagealphablending($resized, false);
                        imagesavealpha($resized, true);
                        imagecopyresampled($resized, $gd, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagedestroy($gd);
                        $gd = $resized;
                    }

                    ob_start();
                    if (function_exists('imagewebp')) {
                        imagewebp($gd, null, $quality);
                        $compressedData = ob_get_clean();
                        imagedestroy($gd);
                        return 'data:image/webp;base64,' . base64_encode($compressedData);
                    } else {
                        imagejpeg($gd, null, $quality);
                        $compressedData = ob_get_clean();
                        imagedestroy($gd);
                        return 'data:image/jpeg;base64,' . base64_encode($compressedData);
                    }
                }
            }
        } catch (\Throwable $e) {
            // Fallback to storing on disk if GD compression fails
        }

        return $file->store($directory, 'public');
    }

    /**
     * Convert an existing file on disk into an optimized WebP data URI.
     */
    public static function fileToDataUri(string $filePath, int $maxWidth = 1200, int $quality = 78): string
    {
        if (!file_exists($filePath)) {
            return '';
        }
        $imageContent = @file_get_contents($filePath);
        if (!$imageContent) {
            return '';
        }
        $gd = @imagecreatefromstring($imageContent);
        if (!$gd) {
            return '';
        }
        $width = imagesx($gd);
        $height = imagesy($gd);
        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int) round(($height / $width) * $newWidth);
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $gd, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($gd);
            $gd = $resized;
        }
        ob_start();
        if (function_exists('imagewebp')) {
            imagewebp($gd, null, $quality);
            $compressedData = ob_get_clean();
            imagedestroy($gd);
            return 'data:image/webp;base64,' . base64_encode($compressedData);
        } else {
            imagejpeg($gd, null, $quality);
            $compressedData = ob_get_clean();
            imagedestroy($gd);
            return 'data:image/jpeg;base64,' . base64_encode($compressedData);
        }
    }

    /**
     * Resolve any image (data URI, remote URL, storage upload, or asset) to a valid browser URL.
     */
    public static function url(?string $path, string $fallback = 'assets/images/burger.png'): string
    {
        if (empty($path)) {
            return asset($fallback);
        }

        if (str_starts_with($path, 'data:') || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'uploads/')) {
            return asset('storage/' . $path);
        }

        return asset($path);
    }
}

if (!function_exists('imageUrl')) {
    function imageUrl(?string $path, string $fallback = 'assets/images/burger.png'): string {
        return \App\Helpers\ImageHelper::url($path, $fallback);
    }
}
