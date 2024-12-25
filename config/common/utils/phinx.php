<?php

namespace Lumenity\Framework\config\common\utils;

use Lumenity\Framework\config\common\app\env;

/**
 * Class phinx
 *
 * This class is used to manage the configuration for the Phinx migration tool.
 * It provides a method to get the configuration as an array.
 *
 * @package Lumenity\Framework\config\common\utils
 */
class phinx
{
    /**
     * Get the configuration for Phinx as an array.
     *
     * This method captures the environment variables and returns an array
     * containing the configuration for Phinx. This includes paths for migrations
     * and seeds, and the default environment configurations.
     *
     * @return array The configuration for Phinx.
     */
    public static function getInstance(): array
    {
        // Capture the environment variables
        env::capture();

        // Return the configuration for Phinx
        return [
            // Define the paths for migrations and seeds
            'paths' => [
                // Path for migration files
                'migrations' => 'database/migrations',
                // Path for seed files
                'seeds' => 'database/seeds',
            ],
            // Define the environments configurations
            'environments' => [
                // Define the default migration table name
                'default_migration_table' => 'migrations',
                // Define the default environment configurations
                'default' => [
                    // Define the database adapter, default is 'mysql'
                    'adapter' => config('database.connection') ?? 'mysql',
                    // Define the host for the database, default is 'localhost'
                    'host' => config('database.host') ?? 'localhost',
                    // Define the name of the database, default is 'Lumenity'
                    'name' => config('database.database') ?? 'Lumenity',
                    // Define the username for the database, default is 'root'
                    'user' => config('database.username') ?? 'root',
                    // Define the password for the database, default is an empty string
                    'pass' => config('database.password') ?? '',
                    // Define the port for the database, default is '3306'
                    'port' => config('database.port') ?? '3306',
                ],
            ],
        ];
    }
}

// Get the instance of the Phinx configuration
return phinx::getInstance();