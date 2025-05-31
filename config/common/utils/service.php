<?php

namespace Lumenity\Framework\config\common\utils;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Lumenity\Framework\config\common\app\pagination;
use Lumenity\Framework\config\common\app\store;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Collection;
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
    public static function drop(string $path, string $fileName): bool
    {
        return Store::drop($path, $fileName);
    }

    /**
     * Render View
     *
     * Renders a view with the provided data.
     *
     * @param int $limit
     * @param int $page
     * @param Model|Builder $query
     * @return Collection
     */
    public static function pagination(int $limit, int $page, Model|Builder $query): Collection
    {
        $pagination = new pagination($limit, $page, $query);
        return $pagination->paginate();
    }
}
