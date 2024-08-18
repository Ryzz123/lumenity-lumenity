<?php

// Namespace declaration for the iprovider interface
namespace Lumenity\Framework\config\common\interface;

/**
 * Interface iprovider
 *
 * This interface is used to define the contract for service providers.
 * It requires the implementation of a register method.
 */
interface iprovider
{
    /**
     * Method register
     *
     * This method is used to register the service provider.
     * The implementation details are left to the specific service provider class.
     */
    public function register();

    /**
     * Method boot
     *
     * This method is used to boot the service provider.
     * The implementation details are left to the specific service provider class.
     */
    public function boot();
}