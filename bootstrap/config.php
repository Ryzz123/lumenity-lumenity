<?php
/**
 * This file is part of the bootstrap process of the application.
 * It returns an array of configuration values that are used in the application.
 *
 * The configuration values are used to configure the application and its services.
 * For example, the app configuration values are used to configure the application itself,
 * the database configuration values are used to configure the database connection,
 * and the cache configuration values are used to configure the cache service.
 *
 * @return array An array of configuration values
 */
return [
    // Application configuration values
    'app' => [
        'version' => $_ENV['APP_VERSION'] ?? '1.0.0',
        'name' => $_ENV['APP_NAME'] ?? 'Lumenity',
        'env' => $_ENV['APP_ENV'] ?? 'production',
        'key' => $_ENV['APP_KEY'] ?? '',
        'debug' => $_ENV['APP_DEBUG'] ?? 'false',
        'url' => $_ENV['APP_URL'] ?? 'http://127.0.0.1:3000/',
    ],
    // Database configuration values
    'database' => [
        'connection' => $_ENV['DB_CONNECTION'] ?? 'mysql',
        'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
        'port' => $_ENV['DB_PORT'] ?? '3306',
        'database' => $_ENV['DB_DATABASE'] ?? 'my_database',
        'username' => $_ENV['DB_USERNAME'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
    ],
];
