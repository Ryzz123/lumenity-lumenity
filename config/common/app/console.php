<?php

namespace Lumenity\Framework\config\common\app;

use Rakit\Console\App;

/**
 * Console Class
 *
 * This class provides methods for managing console commands in the Lumenity Framework.
 * It allows registering and running console commands.
 */
class console
{
    /**
     * The console application instance.
     *
     * @var App The instance of the console application
     */
    protected static App $app;

    /**
     * Constructor
     *
     * Initializes the Console instance.
     */
    public function __construct()
    {
        self::$app = new App();
    }

    /**
     * Register Console Command
     *
     * Registers a console command with the given name and command class.
     *
     * @param string $name The name of the console command
     * @param string $command The class name of the console command
     * @return void
     */
    public static function register(string $name, string $command): void
    {
        // Define and register the console command
        self::$app->command($name, '', function (...$args) use ($command) {
            $argv = $GLOBALS['argv'];
            $options = array_filter($argv, function ($arg) {
                return str_starts_with($arg, '-');
            });

            $command = new $command();
            $command->create(self::$app, $args, $options);
        });
    }

    /**
     * Run Console Application
     *
     * Runs the console application.
     *
     * @return void
     */
    public static function run(): void
    {
        // Run the console application
        self::$app->run();
    }
}