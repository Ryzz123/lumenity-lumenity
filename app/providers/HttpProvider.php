<?php

// Namespace declaration for the ServiceProvider class
namespace Lumenity\Framework\app\providers;

// Importing the provider abstract class from the common interface namespace
use Lumenity\Framework\config\common\http\Request;
use Lumenity\Framework\config\common\http\Response;
use Lumenity\Framework\config\common\interface\provider;

/**
 * Class ServiceProvider
 *
 * This class extends the provider abstract class and implements the register method.
 * It is used as a service provider in the application.
 */
class HttpProvider extends provider
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
        // Bind the request and response objects to the container
        self::$container->bind('req', function () {
            return Request::capture();
        });

        // Bind the response object to the container
        self::$container->bind('res', function () {
            return new Response();
        });
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