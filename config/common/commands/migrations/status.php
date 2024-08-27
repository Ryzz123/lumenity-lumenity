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
     * Check the status of migrations.
     *
     * @param App $app The console application instance.
     * @param string|null $name The name of the migration to check the status for.
     * @param string|null $config The configuration for the migration.
     * @return void
     *
     * This method checks the status of all migrations.
     * The status is displayed in the console.
     * The method uses the phinx migration tool to check the status of the migrations.
     * The configuration for phinx is provided in the config/common/utils/phinx.php file.
     */
    public function create(App $app, ?string $name, ?string $config): void
    {
        // Run the status command
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx status --configuration=config/common/utils/phinx.php");
    }
}