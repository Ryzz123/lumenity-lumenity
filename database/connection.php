<?php

namespace Lumenity\Framework\database;

use Illuminate\Database\Capsule\Manager;

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

    /**
     * connection constructor.
     *
     * The constructor is private to prevent creating multiple instances of this class.
     * It initializes the Capsule Manager and sets up the database connection using the environment variables.
     * It also sets the Capsule Manager instance as global and boots the Eloquent ORM.
     */
    private function __construct()
    {
        $this->capsule = new Manager;

        $this->capsule->addConnection([
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
        $this->capsule->setAsGlobal();

        // Boot Eloquent ORM
        $this->capsule->bootEloquent();
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