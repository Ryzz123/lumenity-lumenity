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
     * The create method.
     *
     * This method is used to run all the database seeds. It executes the phinx seed:run command which runs all the available seeds.
     * After the seeds have been run, it outputs a message to the console.
     *
     * @param App $app An instance of the Rakit\Console\App class.
     * @param string|null $name The name of the seed to run. This parameter is not used in this method.
     * @param string|null $config The configuration for the seed. This parameter is not used in this method.
     * @return void
     */
    public function create(App $app, ?string $name, ?string $config): void
    {
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx seed:run --configuration=config/common/utils/phinx.php");

        $app->writeln("Seeds have been run.");
    }
}