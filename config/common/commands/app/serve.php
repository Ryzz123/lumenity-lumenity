<?php

namespace Lumenity\Framework\config\common\commands\app;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;
use Dotenv\Dotenv;

/**
 * Serve Command
 *
 * This command serves the application on a local server.
 */
class serve implements command
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
     */
    public function create(App $app, array $args, array $option): void
    {
        $port = 3000;
        foreach ($option as $opt) {
            if (str_starts_with($opt, '--port=')) {
                $port = substr($opt, strlen('--port='));
                break;
            }
        }

        $dotenv = Dotenv::createImmutable(".");
        $dotenv->safeLoad();
        $envContent = file_get_contents(".env");
        $envContent = preg_replace("/APP_URL=(.*)/", "APP_URL=http://127.0.0.1:$port/", $envContent);
        file_put_contents(".env", $envContent);

        passthru("php -S 127.0.0.1:$port -t public/");
    }
}