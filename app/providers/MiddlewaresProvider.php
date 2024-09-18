<?php

// Namespace declaration for the ServiceProvider class
namespace Lumenity\Framework\app\providers;

// Importing the provider abstract class from the common interface namespace
use Lumenity\Framework\config\common\interface\provider;

/**
 * Class MiddlewareProvider
 *
 * This class extends the provider abstract class and implements the register method.
 * It is used as a service provider in the application.
 */
class MiddlewaresProvider extends provider
{
    /**
     * Method register
     *
     * This method is required by the provider abstract class.
     * It is used to register the service in the application.
     * The implementation details are left to the specific service provider class.
     */
    public function register(): void
    {
        $middlewares = [
            'cors' => \Lumenity\Framework\app\http\middlewares\cors::class,
            'csrf' => \Lumenity\Framework\app\http\middlewares\csrf::class,
            'json' => \Lumenity\Framework\app\http\middlewares\json::class,
            'logger' => \Lumenity\Framework\app\http\middlewares\logger::class,
            'throttle' => \Lumenity\Framework\app\http\middlewares\throttle::class,
        ];

        foreach ($middlewares as $key => $value) {
            self::$container->bind("make:$key", $value);
        }
    }

    /**
     * Method boot
     *
     * This method is required by the provider abstract class.
     * It is used to boot the service provider.
     * The implementation details are left to the specific service provider class.
     */
    public function boot(): void
    {

    }
}