<?php

// Namespace declaration for the ServiceProvider class
namespace Lumenity\Framework\app\providers;

// Importing the provider abstract class from the common interface namespace
use Lumenity\Framework\config\common\interface\provider;

/**
 * Class ServiceProvider
 *
 * This class extends the provider abstract class and implements the register method.
 * It is used as a service provider in the application.
 */
class ServiceProvider extends provider
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