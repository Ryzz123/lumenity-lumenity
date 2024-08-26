<?php

namespace Lumenity\Framework\config\common\commands;

use Lumenity\Framework\config\common\commands\app\controller;
use Lumenity\Framework\config\common\commands\app\generate;
use Lumenity\Framework\config\common\commands\app\middleware;
use Lumenity\Framework\config\common\commands\app\model;
use Lumenity\Framework\config\common\commands\app\serve;
use Lumenity\Framework\config\common\commands\app\service;
use Lumenity\Framework\config\common\commands\app\tests;

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
            'key:generate' => generate::class
        ];
    }
}