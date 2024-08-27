<?php

namespace Lumenity\Framework\config\common\commands\migrations;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Class migrate
 * This class implements the command interface and provides a method to run migrations.
 */
class migrate implements command
{

    /**
     * Run the migrations.
     *
     * @param App $app The console application instance.
     * @param string|null $name The name of the migration to be run.
     * @param string|null $config The configuration for the migration.
     * @return void
     *
     * This method runs all the migrations that have not been run yet.
     * The migrations are run in the order they were created.
     * The method uses the phinx migration tool to run the migrations.
     * The configuration for phinx is provided in the config/common/utils/phinx.php file.
     * After running the migrations, the method outputs a message to the console.
     */
    public function create(App $app, ?string $name, ?string $config): void
    {
        // Run the migrations
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx migrate --configuration=config/common/utils/phinx.php");

        // Output a message
        $app->writeln("Migrations have been run.");
    }
}