<?php

namespace Lumenity\Framework\common\config\app;

use Closure;
use Lumenity\Framework\Server\App;

/**
 * Route Configuration
 *
 * This class provides a fluent interface for defining routes in the application.
 * It allows grouping routes with a common prefix and defining routes for various HTTP methods.
 */
class route
{
    /** @var string|null The prefix for grouped routes */
    protected ?string $prefix = null;

    /** @var route|null The singleton instance of the Route class */
    private static ?route $instance = null;

    /**
     * Get Singleton Instance
     *
     * Returns the singleton instance of the Route class.
     *
     * @return route The singleton instance of the Route class
     */
    public static function getInstance(): route
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Group Routes
     *
     * Creates a group of routes with a common prefix.
     *
     * @param string $prefix The common prefix for the grouped routes
     * @param Closure $callback The callback function to define routes within the group
     * @return void
     */
    public static function group(string $prefix, Closure $callback): void
    {
        // Get the singleton instance of the Route class
        $route = self::getInstance();

        // Set the prefix for the group
        $route->setPrefix($prefix);

        // Execute the callback function to define routes within the group
        $callback($route);
    }

    /**
     * Set Prefix
     *
     * Sets the prefix for the grouped routes.
     *
     * @param string $prefix The common prefix for the grouped routes
     * @return void
     */
    protected function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * Define GET Route
     *
     * Defines a route for the GET HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param string $controller The name of the controller class handling the route
     * @param string $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function get(string $path, string $controller, string $method, array $middleware = []): void
    {
        $route = self::getInstance();
        $route->addRoute('GET', $path, $controller, $method, $middleware);
    }

    /**
     * Define POST Route
     *
     * Defines a route for the POST HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param string $controller The name of the controller class handling the route
     * @param string $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function post(string $path, string $controller, string $method, array $middleware = []): void
    {
        $route = self::getInstance();
        $route->addRoute('POST', $path, $controller, $method, $middleware);
    }

    /**
     * Define PUT Route
     *
     * Defines a route for the PUT HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param string $controller The name of the controller class handling the route
     * @param string $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function put(string $path, string $controller, string $method, array $middleware = []): void
    {
        $route = self::getInstance();
        $route->addRoute('PUT', $path, $controller, $method, $middleware);
    }

    /**
     * Define DELETE Route
     *
     * Defines a route for the DELETE HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param string $controller The name of the controller class handling the route
     * @param string $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function delete(string $path, string $controller, string $method, array $middleware = []): void
    {
        $route = self::getInstance();
        $route->addRoute('DELETE', $path, $controller, $method, $middleware);
    }

    /**
     * Define PATCH Route
     *
     * Defines a route for the PATCH HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param string $controller The name of the controller class handling the route
     * @param string $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function patch(string $path, string $controller, string $method, array $middleware = []): void
    {
        $route = self::getInstance();
        $route->addRoute('PATCH', $path, $controller, $method, $middleware);
    }

    /**
     * Add Route
     *
     * Adds a route with the specified method, path, controller, method, and optional middleware.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE, etc.)
     * @param string $path The URL path pattern for the route
     * @param string $controller The name of the controller class handling the route
     * @param string $methodController The name of the method within the controller class
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    protected function addRoute(string $method, string $path, string $controller, string $methodController, array $middleware = []): void
    {
        // Concatenate route path with group prefix, if exists
        $prefix = $this->prefix ?? '';
        $path = rtrim($prefix, '/') . '/' . ltrim($path, '/');

        // Register the route with the application server
        App::add($method, $path, $controller, $methodController, $middleware);
    }
}
