<?php

// Namespace declaration for the ioc class
namespace Lumenity\Framework\config\common\app;

// Importing the Container class from the Illuminate\Container namespace
use Illuminate\Container\Container;

/**
 * Class ioc
 *
 * This class extends the Container class from the Illuminate\Container namespace.
 * It provides methods to register service providers.
 */
class ioc extends Container
{
    /**
     * Method register
     *
     * This method is used to register a single service provider.
     * It creates an instance of the service provider class and calls its register method.
     *
     * @param string $provider The fully qualified class name of the service provider.
     */
    public function register(string $provider): void
    {
        $providerInstance = new $provider($this);
        $providerInstance->register();

        if (method_exists($providerInstance, 'boot')) {
            $providerInstance->boot();
        }
    }

    /**
     * Method registerProviders
     *
     * This method is used to register multiple service providers.
     * It loops through an array of service providers and calls the register method for each one.
     *
     * @param array $providers An array of fully qualified class names of the service providers.
     */
    public function registerProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            $this->register($provider);
        }
    }
}