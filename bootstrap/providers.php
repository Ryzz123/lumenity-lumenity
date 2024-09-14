<?php

/**
 * This file is part of the bootstrap process of the application.
 * It returns an array of service providers that are registered in the application.
 *
 * Each service provider is responsible for bootstrapping a specific part of the application.
 * For example, the ServiceProvider is the main service provider of the application,
 * the HttpProvider is responsible for bootstrapping the HTTP layer of the application,
 * and the MiddlewaresProvider is responsible for bootstrapping the middleware layer of the application.
 *
 * @return array An array of fully qualified class names of the service providers
 */
return [
    \Lumenity\Framework\app\providers\ServiceProvider::class,
    \Lumenity\Framework\app\providers\HttpProvider::class,
    \Lumenity\Framework\app\providers\MiddlewaresProvider::class,
];