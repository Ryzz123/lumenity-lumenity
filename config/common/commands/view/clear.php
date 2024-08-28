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
     * The create method.
     *
     * This method is used to clear the cache for the views. It gets all the files in the cache directory and deletes them.
     * After the cache has been cleared, it outputs a message to the console.
     *
     * @param App $app An instance of the Rakit\Console\App class.
     * @param string|null $name This parameter is not used in this method.
     * @param string|null $config This parameter is not used in this method.
     * @return void
     */
    public function create(App $app, ?string $name, ?string $config): void
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