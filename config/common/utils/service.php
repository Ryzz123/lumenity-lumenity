<?php

namespace Lumenity\Framework\config\common\utils;

use Exception;
use Lumenity\Framework\config\common\app\store;
use Lumenity\Framework\config\common\app\log as Log;
use Illuminate\Database\Capsule\Manager;
use Lumenity\Framework\config\common\app\validator;
use Throwable;

/**
 * Service Class
 *
 * This class provides various utility methods commonly used across the application.
 * It includes methods for managing database transactions, file storage, logging, and validation.
 */
class service
{
    /**
     * Begin Transaction
     *
     * Starts a new database transaction.
     *
     * @throws Exception If an error occurs while starting the transaction
     * @throws Throwable If the transaction cannot be started
     */
    public static function beginTransaction(): void
    {
        $DB = Manager::connection()->getPdo();
        try {
            $DB->beginTransaction();
        } catch (Throwable $e) {
            throw new Exception("Failed to begin transaction: " . $e->getMessage());
        }
    }

    /**
     * Commit Transaction
     *
     * Commits the active database transaction.
     *
     * @throws Exception If an error occurs while committing the transaction
     * @throws Throwable If the transaction cannot be committed
     */
    public static function commit(): void
    {
        $DB = Manager::connection()->getPdo();
        try {
            $DB->commit();
        } catch (Throwable $e) {
            throw new Exception("Failed to commit transaction: " . $e->getMessage());
        }
    }

    /**
     * Rollback Transaction
     *
     * Rolls back the active database transaction.
     *
     * @throws Exception If an error occurs while rolling back the transaction
     * @throws Throwable If the transaction cannot be rolled back
     */
    public static function rollback(): void
    {
        $DB = Manager::connection()->getPdo();
        try {
            $DB->rollBack();
        } catch (Throwable $e) {
            throw new Exception("Failed to rollback transaction: " . $e->getMessage());
        }
    }

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
    public static function store(string $path, mixed $file, ?string $hashname = null): string
    {
        return Store::store($path, $file, $hashname);
    }

    /**
     * Delete File
     *
     * Deletes the specified file from the filesystem.
     *
     * @param string $path The directory path where the file is located
     * @param string $fileName The name of the file to be deleted
     * @return bool True if the file is successfully deleted, false otherwise
     * @throws Exception If an error occurs during file deletion
     */
    public static function delete(string $path, string $fileName): bool
    {
        return Store::delete($path, $fileName);
    }

    /**
     * Log Message
     *
     * Logs a message with the specified log level.
     *
     * @param string $message The message to be logged
     * @param string $type Optional. The log level (info, warning, error, debug, critical)
     * @return void
     */
    public static function log(string $message, string $type = 'info'): void
    {
        switch ($type) {
            case 'info':
                Log::info($message);
                break;
            case 'warning':
                Log::warning($message);
                break;
            case 'error':
                Log::error($message);
                break;
            case 'debug':
                Log::debug($message);
                break;
            case 'critical':
                Log::critical($message);
                break;
        }
    }

    /**
     * Validate Data
     *
     * Validates the given data against the specified validation rules.
     *
     * @param array $data The data to be validated
     * @param array $rules The validation rules
     * @return array An array containing validation errors, if any
     */
    public static function validator(array $data, array $rules): array
    {
        $validator = new Validator();
        if (!$validator->validate($data, $rules)) {
            return $validator->errors();
        } else {
            return [];
        }
    }
}
