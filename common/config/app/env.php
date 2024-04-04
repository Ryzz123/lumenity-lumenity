<?php

namespace Nexus\Framework\Common\Config\App;

use Dotenv\Dotenv;

/**
 * Environment Configuration
 *
 * This class handles the capture and initialization of environment variables
 * required for the application.
 */
class env
{
    /**
     * Capture Environment Variables
     *
     * Initializes the environment variables by loading them from the .env file
     * located in the project root directory.
     *
     * @return void
     */
    public static function capture(): void
    {
        $envFilePath = __DIR__ . '/../../../.env';

        if (file_exists($envFilePath)) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        } else {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../', '.env.example');
        }
        $dotenv->load();
    }
}
