<?php

namespace Lumenity\Framework\config\common\commands\migrations;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Class rollback
 * This class implements the command interface and provides a method to rollback migrations.
 */
class rollback implements command
{

    /**
     * Rollback the migrations.
     *
     * @param App $app The console application instance.
     * @param string|null $name The name of the migration to be rolled back.
     * @param string|null $config The configuration for the migration.
     * @return void
     *
     * This method rolls back all the migrations that have been run.
     * The migrations are rolled back in the reverse order they were run.
     * The method uses the phinx migration tool to rollback the migrations.
     * The configuration for phinx is provided in the config/common/utils/phinx.php file.
     * After rolling back the migrations, the method outputs a message to the console.
     */
    public function create(App $app, ?string $name, ?string $config): void
    {
        // Run the rollback command
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx rollback --configuration=config/common/utils/phinx.php");

        // Output a message
        $app->writeln("Migrations have been rolled back.");
    }
}