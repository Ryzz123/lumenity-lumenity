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
     * Create
     *
     * This method creates a new middleware in the application.
     *
     * @param App $app
     * @param array $args
     * @param array $option
     * @return void
     * @throws Exception
     */
    public function create(App $app, array $args, array $option): void
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