<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileHelper
{
    /**
     * Get file URL from path, supporting both S3 and local storage
     * 
     * @param string|null $path File path
     * @param string $disk Storage disk (s3, local, public)
     * @return string|null File URL or null if path is empty
     */
    public static function getFileUrl($path, $disk = 's3')
    {
        if (empty($path)) {
            return null;
        }

        // Nếu path đã là URL đầy đủ
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Kiểm tra xem có phải file S3 không
        if (self::isS3Path($path)) {
            return self::generateS3Url($path);
        }

        // Fallback về local storage
        return self::generateLocalUrl($path);
    }

    /**
     * Check if path is from S3 storage
     * 
     * @param string $path
     * @return bool
     */
    private static function isS3Path($path)
    {
        // Kiểm tra các pattern phổ biến của S3 path
        $s3Patterns = [
            'profile/',
            'uploads/',
            'images/',
            'documents/'
        ];

        foreach ($s3Patterns as $pattern) {
            if (strpos($path, $pattern) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate S3 URL
     * 
     * @param string $path
     * @return string
     */
    private static function generateS3Url($path)
    {
        try {
            $bucket = config('filesystems.disks.s3.bucket');
            $region = config('filesystems.disks.s3.region');
            $url = config('filesystems.disks.s3.url');
            $endpoint = config('filesystems.disks.s3.endpoint');

            // Nếu có custom URL hoặc endpoint
            if ($url) {
                return rtrim($url, '/') . '/' . $path;
            }

            if ($endpoint) {
                return rtrim($endpoint, '/') . '/' . $bucket . '/' . $path;
            }

            // Standard S3 URL format
            if ($bucket && $region) {
                return "https://{$bucket}.s3.{$region}.amazonaws.com/{$path}";
            }

            // Fallback nếu không có config đầy đủ
            Log::warning('S3 configuration incomplete for path: ' . $path);
            return self::generateLocalUrl($path);

        } catch (\Exception $e) {
            Log::error('Error generating S3 URL for path: ' . $path, [
                'error' => $e->getMessage()
            ]);
            return self::generateLocalUrl($path);
        }
    }

    /**
     * Generate local storage URL
     * 
     * @param string $path
     * @return string
     */
    private static function generateLocalUrl($path)
    {
        // Loại bỏ 'public/' prefix nếu có
        if (strpos($path, 'public/') === 0) {
            $path = substr($path, 7);
        }

        return asset('storage/' . $path);
    }

    /**
     * Get profile image URL specifically
     * 
     * @param string|null $path
     * @return string|null
     */
    public static function getProfileImageUrl($path)
    {
        return self::getFileUrl($path, 's3');
    }

    /**
     * Upload file to storage with fallback
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param string $primaryDisk
     * @param string $fallbackDisk
     * @return string|null
     */
    public static function uploadFile($file, $directory = 'uploads', $primaryDisk = 's3', $fallbackDisk = 'public')
    {
        try {
            // Thử upload lên primary disk
            $path = $file->store($directory, $primaryDisk);
            
            // Nếu là public disk, loại bỏ 'public/' prefix
            if ($fallbackDisk === 'public' && strpos($path, 'public/') === 0) {
                $path = substr($path, 7);
            }
            
            return $path;
        } catch (\Exception $e) {
            Log::warning("Failed to upload to {$primaryDisk}, falling back to {$fallbackDisk}", [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName()
            ]);

            try {
                // Fallback to secondary disk
                $path = $file->store($directory, $fallbackDisk);
                
                if ($fallbackDisk === 'public' && strpos($path, 'public/') === 0) {
                    $path = substr($path, 7);
                }
                
                return $path;
            } catch (\Exception $fallbackException) {
                Log::error("Failed to upload file to both disks", [
                    'primary_error' => $e->getMessage(),
                    'fallback_error' => $fallbackException->getMessage(),
                    'file' => $file->getClientOriginalName()
                ]);
                
                return null;
            }
        }
    }
} 