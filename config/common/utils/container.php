<?php

// Namespace declaration for the container class
namespace Lumenity\Framework\config\common\utils;

// Importing the ioc class from the app namespace
use Lumenity\Framework\config\common\app\ioc;

/**
 * Class container
 *
 * This class is used to manage the dependency injection container.
 * It uses the ioc class to register service providers.
 */
class container
{
    // Static property to hold the instance of the ioc container
    public static ioc $container;

    // Static property to hold the instance of the container class
    private static container $instance;

    /**
     * Constructor for the container class.
     *
     * It creates a new instance of the ioc class and registers the service providers.
     * The instance of the ioc class is then stored in the static $container property.
     */
    public function __construct()
    {
        // Creating a new instance of the ioc class
        $container = new ioc();

        // Array of service providers to be registered
        $providers = require __DIR__ . '/../../../bootstrap/providers.php';

        // Registering the service providers with the ioc container
        $container->registerProviders($providers);

        // Storing the ioc container instance in the static $container property
        self::$container = $container;
    }

    /**
     * Method getInstance
     *
     * This method is used to get the instance of the container class.
     * If an instance does not exist, it creates a new one and returns it.
     *
     * @return container The instance of the container class.
     */
    public static function getInstance(): container
    {
        if (!isset(self::$instance)) {
            self::$instance = new container();
        }

        return self::$instance;
    }
}