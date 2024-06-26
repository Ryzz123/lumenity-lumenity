<?php

namespace Lumenity\Framework\config\common\commands\app;

use Rakit\Console\App;

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
     * This method creates a new instance of the application.
     *
     * @param App $app
     * @param string|null $name
     * @return void
     */
    public function create(App $app, ?string $name): void
    {
        passthru('php -S 127.0.0.1:3000 -t public/');
    }
}