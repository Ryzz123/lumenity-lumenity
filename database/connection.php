<?php

namespace Lumenity\Framework\database;

use Illuminate\Database\Capsule\Manager;

/**
 * Database Bootstrap
 *
 * This class initializes the database connection using Laravel's Eloquent ORM.
 */
class connection
{
    /**
     * Bootstrap Database
     *
     * Initializes the database connection using the configuration settings
     * defined in the environment variables.
     */
    public function __construct()
    {
        // Create a new instance of Capsule Manager
        $capsule = new Manager;

        // Add connection configuration
        $capsule->addConnection([
            'driver'    => $_ENV['DB_CONNECTION'] ?? 'mysql',
            'host'      => $_ENV['DB_HOST'] ?? 'localhost',
            'port'      => $_ENV['DB_PORT'] ?? '3306',
            'database'  => $_ENV['DB_DATABASE'] ?? 'Lumenity',
            'username'  => $_ENV['DB_USERNAME'] ?? 'root',
            'password'  => $_ENV['DB_PASSWORD'] ?? '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Set the Capsule Manager instance as global
        $capsule->setAsGlobal();

        // Boot Eloquent ORM
        $capsule->bootEloquent();
    }
}
