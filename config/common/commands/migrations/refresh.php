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
        // Run the rollback command
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx rollback -t 0 --configuration=config/common/utils/phinx.php");

        // Run the migrations
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx migrate --configuration=config/common/utils/phinx.php");

        // Output a message
        $app->writeln("Migrations have been refreshed.");
    }
}