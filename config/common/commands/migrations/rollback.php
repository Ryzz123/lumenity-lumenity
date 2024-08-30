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
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx rollback --configuration=config/common/utils/phinx.php");

        // Output a message
        $app->writeln("Migrations have been rolled back.");
    }
}