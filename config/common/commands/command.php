<?php

namespace Lumenity\Framework\config\common\commands;

use Lumenity\Framework\config\common\commands\app\controller;
use Lumenity\Framework\config\common\commands\app\generate;
use Lumenity\Framework\config\common\commands\app\middleware;
use Lumenity\Framework\config\common\commands\app\model;
use Lumenity\Framework\config\common\commands\app\serve;
use Lumenity\Framework\config\common\commands\app\service;
use Lumenity\Framework\config\common\commands\app\tests;
use Lumenity\Framework\config\common\commands\migrations\create;
use Lumenity\Framework\config\common\commands\migrations\fresh;
use Lumenity\Framework\config\common\commands\migrations\migrate;
use Lumenity\Framework\config\common\commands\migrations\refresh;
use Lumenity\Framework\config\common\commands\migrations\rollback;
use Lumenity\Framework\config\common\commands\migrations\status;
use Lumenity\Framework\config\common\commands\seeds\createseed;
use Lumenity\Framework\config\common\commands\seeds\run;
use Lumenity\Framework\config\common\commands\view\cache;
use Lumenity\Framework\config\common\commands\view\clear;

/**
 * Command Class
 *
 * This class provides a method to capture all the commands available in the Lumenity Framework.
 */
class command
{
    /**
     * Capture Commands
     *
     * Returns an array of all the commands available in the Lumenity Framework.
     *
     * @return array
     */
    public static function capture(): array
    {
        return [
            'serve' => serve::class,
            'make:model {name}' => model::class,
            'make:controller {name}' => controller::class,
            'make:middleware {name}' => middleware::class,
            'make:test {name}' => tests::class,
            'make:service {name}' => service::class,
            'key:generate' => generate::class,
            'make:migration {name}' => create::class,
            'make:factory {name}' => createseed::class,
            'migrate' => migrate::class,
            'factory' => run::class,
            'migrate:rollback' => rollback::class,
            'migrate:refresh' => refresh::class,
            'migrate:status' => status::class,
            'view:cache' => cache::class,
            'view:clear' => clear::class,
        ];
    }
}