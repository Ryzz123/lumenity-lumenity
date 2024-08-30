<?php

namespace Lumenity\Framework\config\common\commands\app;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;
use Dotenv\Dotenv;
use Random\RandomException;

/**
 * Class generate
 * This class implements the 'command' interface and provides a method to create a new application.
 */
class generate implements command
{
    /**
     * Create
     *
     * This method creates a new middleware in the application.
     *
     * @param App $app
     * @param array $args
     * @param array $option
     * @return void
     * @throws RandomException
     */
    public function create(App $app, array $args, array $option): void
    {
        // Create a new Dotenv instance pointing to the root directory of the application.
        $dotenv = Dotenv::createImmutable(".");
        // Load the environment file (.env) into the environment variables.
        // If the .env file is not found, this method will return without throwing an exception.
        $dotenv->safeLoad();
        // Generate a new application key.
        $key = "base64:" . base64_encode(random_bytes(32));

        // Get the content of the .env file.
        $envContent = file_get_contents(".env");
        // Replace the existing APP_KEY in the .env file with the new key.
        $envContent = preg_replace("/APP_KEY=(.*)/", "APP_KEY=$key", $envContent);
        // Write the updated content back to the .env file.
        file_put_contents(".env", $envContent);
    }
}