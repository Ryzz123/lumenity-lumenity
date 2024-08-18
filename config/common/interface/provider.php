<?php

// Namespace declaration for the provider abstract class
namespace Lumenity\Framework\config\common\interface;

// Importing the Container class from the Illuminate\Container namespace
use Illuminate\Container\Container;

/**
 * Abstract class provider
 *
 * This abstract class implements the iprovider interface and provides a base for service provider classes.
 * It includes a constructor that accepts an instance of the Container class.
 */
abstract class provider implements iprovider
{
    // Protected property to hold the instance of the Container class
    protected Container $container;

    /**
     * Constructor for the provider abstract class.
     *
     * It accepts an instance of the Container class and stores it in the $container property.
     * This allows the service provider to interact with the dependency injection container.
     *
     * @param Container $container An instance of the Container class.
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}