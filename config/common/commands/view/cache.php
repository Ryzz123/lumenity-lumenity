<?php

namespace Lumenity\Framework\config\common\commands\view;

use Exception;
use FilesystemIterator;
use Lumenity\Framework\config\common\app\view;
use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class cache
 *
 * This class implements the command interface and is used to create a cache for the views.
 *
 * @package Lumenity\Framework\config\common\commands\view
 */
class cache implements command
{

    /**
     * The create method.
     *
     * This method is used to create a cache for the views. It gets all the view files in the views directory and compiles them.
     * After the views have been compiled, it outputs a message to the console.
     *
     * @param App $app An instance of the Rakit\Console\App class.
     * @param string|null $name This parameter is not used in this method.
     * @param string|null $config This parameter is not used in this method.
     * @throws Exception If there is an error during the compilation of the views.
     * @return void
     */
    public function create(App $app, ?string $name, ?string $config): void
    {
        $blade = view::getInstance()->blade;
        $directory = view::$viewsPath;
        $files = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $filePath = $file->getRealPath();
                if (str_ends_with($filePath, '.blade.php')) {
                    $files[] = $filePath;
                }
            }
        }

        $directory = realpath(view::$viewsPath);
        $files = array_map(function ($file) use ($directory) {
            $relativePath = str_replace($directory . DIRECTORY_SEPARATOR, '', $file);
            $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);
            if (substr_count($relativePath, '/') === 0) {
                $relativePath = str_replace('.blade.php', '', $relativePath);
            }
            return $relativePath;
        }, $files);

        foreach ($files as $file) {
            $blade->compile($file);
        }

        $app->writeln("Cache has been created.");
    }
}