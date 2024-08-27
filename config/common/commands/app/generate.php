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
     * Create a new application.
     *
     * This method generates a new application key and updates the .env file with the new key.
     * The application key is a base64 encoded string of 32 random bytes.
     *
     * @param App $app The application instance.
     * @param string|null $name The name of the application. Currently not used.
     * @param string|null $config The configuration for the application. Currently not used.
     * @throws RandomException If the random_bytes function fails.
     */
    public function create(App $app, ?string $name, ?string $config): void
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