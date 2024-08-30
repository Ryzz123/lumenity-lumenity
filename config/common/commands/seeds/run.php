<?php

namespace Lumenity\Framework\config\common\commands\seeds;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Class run
 *
 * This class implements the command interface and is used to run database seeds.
 *
 * @package Lumenity\Framework\config\common\commands\seeds
 */
class run implements command
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
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx seed:run --configuration=config/common/utils/phinx.php");

        $app->writeln("Seeds have been run.");
    }
}