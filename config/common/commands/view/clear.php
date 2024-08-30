<?php

namespace Lumenity\Framework\config\common\commands\view;

use Lumenity\Framework\config\common\app\view;
use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Class clear
 *
 * This class implements the command interface and is used to clear the cache for the views.
 *
 * @package Lumenity\Framework\config\common\commands\view
 */
class clear implements command
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
        $directory = view::$cachePath;
        $files = glob($directory . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        $app->writeln("View cache cleared.");
    }
}