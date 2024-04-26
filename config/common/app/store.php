<?php

namespace Lumenity\Framework\config\common\app;

use Exception;
/**
 * File Storage Class
 *
 * This class provides methods for storing files in the filesystem.
 * It includes functionality to generate unique hash names for stored files.
 */
class store
{
    /**
     * Store File
     *
     * Stores the uploaded file in the specified path with an optional hash name.
     *
     * @param string $path The directory path where the file will be stored
     * @param mixed $file The uploaded file object
     * @param string|null $hashname Optional. The custom hash name for the stored file
     * @return string The stored file name with its extension
     * @throws Exception If an error occurs during file storage
     */
    public static function store(string $path, mixed $file, ?string $hashname = null): string {
        try {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = $hashname ?? self::generateHashName($originalName);

            $fileNameWithExtension = $fileName . '.' . $extension;
            if (!$file->move($path, $fileNameWithExtension)) {
                throw new Exception('Failed to store file.');
            }

            return $fileNameWithExtension;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     *
     * Delete File
     * Deletes the specified file from the filesystem.
     */
    public static function delete(string $path, string $fileName): bool
    {
        try {
            $filePath = $path . '/' . $fileName;
            if (file_exists($filePath)) {
                return unlink($filePath);
            }

            return false;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Generate Hash Name
     *
     * Generates a unique hash name for the stored file based on the original file name.
     *
     * @param string $fileName The original file name
     * @return string The generated hash name
     */
    private static function generateHashName(string $fileName): string {
        return md5($fileName . uniqid() . microtime());
    }
}
