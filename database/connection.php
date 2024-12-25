<?php

namespace Lumenity\Framework\database;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Builder;

/**
 * Class connection
 *
 * This class is responsible for managing the database connection using the Illuminate Database Capsule Manager.
 * It follows the Singleton design pattern to ensure that only one instance of this class exists during the application's lifecycle.
 *
 * @package Lumenity\Framework\database
 */
class connection
{
    /**
     * The single instance of the class.
     *
     * @var self|null
     */
    private static ?self $instance = null;

    /**
     * The Capsule Manager instance.
     *
     * @var Manager
     */
    private Manager $capsule;

    // The schema builder instance
    private static Builder $schema;

    // The connection
    private static ?Manager $connection = null;

    /**
     * connection constructor.
     *
     * The constructor is private to prevent creating multiple instances of this class.
     * It initializes the Capsule Manager and sets up the database connection using the environment variables.
     * It also sets the Capsule Manager instance as global and boots the Eloquent ORM.
     */
    private function __construct()
    {
        if (self::$connection) {
            $this->capsule = self::$connection;
            self::$schema = $this->capsule->schema();
        } else {
            $this->capsule = new Manager;

            $this->capsule->addConnection([
                'driver' => config('database.connection') ?? 'mysql',
                'host' => config('database.host') ?? 'localhost',
                'port' => config('database.port') ?? '3306',
                'database' => config('database.database') ?? 'Lumenity',
                'username' => config('database.username') ?? 'root',
                'password' => config('database.password') ?? '',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ]);

            // Set the Capsule Manager instance as global
            $this->capsule->setAsGlobal();

            // Boot Eloquent ORM
            $this->capsule->bootEloquent();

            // Set the schema builder instance
            self::$schema = $this->capsule->schema();

            // Set the connection
            self::$connection = $this->capsule;
        }
    }

    /**
     * Get the schema builder instance.
     *
     * This method is used to get the schema builder instance.
     *
     * @return Builder The schema builder instance.
     */
    public static function schema(): Builder
    {
        connection::getInstance();
        return self::$schema;
    }

    /**
     * Get the single instance of the class.
     *
     * This method is used to get the single instance of this class.
     * If the instance does not exist, it creates a new one.
     *
     * @return self The single instance of the class.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}