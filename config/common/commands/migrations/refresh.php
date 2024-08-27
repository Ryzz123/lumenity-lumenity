<?php

namespace Lumenity\Framework\config\common\commands\migrations;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Class refresh
 * This class implements the command interface and provides a method to refresh migrations.
 */
class refresh implements command
{

    /**
     * Refresh the migrations.
     *
     * @param App $app The console application instance.
     * @param string|null $name The name of the migration to be refreshed.
     * @param string|null $config The configuration for the migration.
     * @return void
     *
     * This method first rolls back all migrations to the initial state (version 0) and then runs all migrations.
     * The rollback and migrate commands are executed using the phinx migration tool.
     * The configuration for phinx is provided in the config/common/utils/phinx.php file.
     * After refreshing the migrations, the method outputs a message to the console.
     */
    public function create(App $app, ?string $name, ?string $config): void
    {
        // Run the rollback command
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx rollback -t 0 --configuration=config/common/utils/phinx.php");

        // Run the migrations
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx migrate --configuration=config/common/utils/phinx.php");

        // Output a message
        $app->writeln("Migrations have been refreshed.");
    }
}