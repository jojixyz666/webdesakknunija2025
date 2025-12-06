<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageCompressor
{
    /**
     * Compress uploaded image and store to public disk under given directory.
     * Attempts to keep under $maxBytes by adjusting quality.
     * Supports JPEG and PNG. Other types will be stored as-is.
     */
    public static function compressAndStore(UploadedFile $file, string $directory, int $maxBytes = 2097152): string
    {
        $mime = $file->getMimeType();
        $ext = strtolower($file->getClientOriginalExtension());

        if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
            // store as-is for unsupported types like webp
            return $file->store($directory, 'public');
        }

        $imageData = file_get_contents($file->getRealPath());
        if ($imageData === false) {
            return $file->store($directory, 'public');
        }

        if (in_array($ext, ['jpg', 'jpeg'])) {
            $img = imagecreatefromstring($imageData);
            if ($img === false) {
                return $file->store($directory, 'public');
            }
            // Binary search quality to meet maxBytes
            $low = 40; $high = 85; $best = 80; $result = null;
            while ($low <= $high) {
                $q = intdiv($low + $high, 2);
                $tmp = self::bufferImageJpeg($img, $q);
                if ($tmp === null) break;
                if (strlen($tmp) > $maxBytes) {
                    $high = $q - 1; // too big, reduce quality
                } else {
                    $best = $q; $result = $tmp; $low = $q + 1; // can increase a bit
                }
            }
            if (!$result) {
                $result = self::bufferImageJpeg($img, 75);
            }
            imagedestroy($img);
            $path = self::storeBuffer($result, $directory, 'jpg');
            return $path;
        }

        if ($ext === 'png') {
            $img = imagecreatefromstring($imageData);
            if ($img === false) {
                return $file->store($directory, 'public');
            }
            // Try PNG compression level 9 downwards
            $bestBuf = null; $bestLevel = 9;
            for ($level = 9; $level >= 0; $level--) {
                $buf = self::bufferImagePng($img, $level);
                if ($buf === null) break;
                $bestBuf = $buf; $bestLevel = $level;
                if (strlen($buf) <= $maxBytes) break;
            }
            // If still larger, fallback to JPEG to reduce size
            if ($bestBuf !== null && strlen($bestBuf) <= $maxBytes) {
                imagedestroy($img);
                return self::storeBuffer($bestBuf, $directory, 'png');
            } else {
                // convert to JPEG background white
                $jpegImg = imagecreatetruecolor(imagesx($img), imagesy($img));
                $white = imagecolorallocate($jpegImg, 255, 255, 255);
                imagefilledrectangle($jpegImg, 0, 0, imagesx($img), imagesy($img), $white);
                imagecopy($jpegImg, $img, 0, 0, 0, 0, imagesx($img), imagesy($img));
                imagedestroy($img);
                $low = 40; $high = 85; $best = 80; $result = null;
                while ($low <= $high) {
                    $q = intdiv($low + $high, 2);
                    $tmp = self::bufferImageJpeg($jpegImg, $q);
                    if ($tmp === null) break;
                    if (strlen($tmp) > $maxBytes) {
                        $high = $q - 1;
                    } else {
                        $best = $q; $result = $tmp; $low = $q + 1;
                    }
                }
                if (!$result) {
                    $result = self::bufferImageJpeg($jpegImg, 75);
                }
                imagedestroy($jpegImg);
                return self::storeBuffer($result, $directory, 'jpg');
            }
        }

        // Fallback store as-is
        return $file->store($directory, 'public');
    }

    private static function bufferImageJpeg($img, int $quality): ?string
    {
        ob_start();
        $ok = imagejpeg($img, null, $quality);
        $data = $ok ? ob_get_clean() : null;
        if (!$ok) { ob_end_clean(); }
        return $data;
    }

    private static function bufferImagePng($img, int $level): ?string
    {
        ob_start();
        $ok = imagepng($img, null, $level);
        $data = $ok ? ob_get_clean() : null;
        if (!$ok) { ob_end_clean(); }
        return $data;
    }

    private static function storeBuffer(string $buffer, string $directory, string $extension): string
    {
        $filename = $directory.'/'.uniqid('img_', true).'.'.$extension;
        Storage::disk('public')->put($filename, $buffer);
        return $filename;
    }
}
