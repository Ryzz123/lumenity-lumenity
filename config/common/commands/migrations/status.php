<?php

namespace Lumenity\Framework\config\common\commands\migrations;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Class status
 * This class implements the command interface and provides a method to check the status of migrations.
 */
class status implements command
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
        // Run the status command
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx status --configuration=config/common/utils/phinx.php");
    }
}