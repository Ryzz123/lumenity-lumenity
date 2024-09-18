<?php

namespace Lumenity\Framework\config\common\app;

use Closure;

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

        // Save the current prefix to restore it later
        $previousPrefix = $route->prefix;

        // Set the new prefix by concatenating the previous one
        $newPrefix = rtrim($previousPrefix, '/') . '/' . ltrim($prefix, '/');
        $route->setPrefix($newPrefix);

        // Execute the callback function to define routes within the group
        $callback($route);

        // Restore the previous prefix after group processing
        $route->setPrefix($previousPrefix);
    }

    /**
     * Set Prefix
     *
     * Sets the prefix for the grouped routes.
     *
     * @param string|null $prefix The common prefix for the grouped routes
     * @return void
     */
    protected function setPrefix(?string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * Define GET Route
     *
     * Defines a route for the GET HTTP method with the specified path, handler, and optional middleware.
     * The handler can be either a controller class with a method or a closure (callback function).
     *
     * @param string $path The URL path pattern for the route
     * @param callable|string $handler The controller class and method or a callback function handling the route
     * @param string|null $method The method name if the handler is a controller class (optional)
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function get(string $path, callable|string $handler, ?string $method = null, array $middleware = []): void
    {
        $route = self::getInstance();

        if (is_callable($handler)) {
            // Handle the case where $handler is a callable (function)
            $route->addRoute('GET', $path, $handler, null, $middleware);
        } else {
            // Handle the case where $handler is a controller class
            $route->addRoute('GET', $path, $handler, $method, $middleware);
        }
    }


    /**
     * Define POST Route
     *
     * Defines a route for the POST HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param callable|string $handler The name of the controller class handling the route
     * @param string|null $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function post(string $path, callable|string $handler, ?string $method, array $middleware = []): void
    {
        $route = self::getInstance();

        if (is_callable($handler)) {
            // Handle the case where $handler is a callable (function)
            $route->addRoute('POST', $path, $handler, null, $middleware);
        } else {
            // Handle the case where $handler is a controller class
            $route->addRoute('POST', $path, $handler, $method, $middleware);
        }
    }

    /**
     * Define PUT Route
     *
     * Defines a route for the PUT HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param callable|string $handler The name of the controller class handling the route
     * @param string|null $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function put(string $path, callable|string $handler, ?string $method, array $middleware = []): void
    {
        $route = self::getInstance();

        if (is_callable($handler)) {
            // Handle the case where $handler is a callable (function)
            $route->addRoute('PUT', $path, $handler, null, $middleware);
        } else {
            // Handle the case where $handler is a controller class
            $route->addRoute('PUT', $path, $handler, $method, $middleware);
        }
    }

    /**
     * Define DELETE Route
     *
     * Defines a route for the DELETE HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param callable|string $handler The name of the controller class handling the route
     * @param string|null $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function delete(string $path, callable|string $handler, ?string $method, array $middleware = []): void
    {
        $route = self::getInstance();

        if (is_callable($handler)) {
            // Handle the case where $handler is a callable (function)
            $route->addRoute('DELETE', $path, $handler, null, $middleware);
        } else {
            // Handle the case where $handler is a controller class
            $route->addRoute('DELETE', $path, $handler, $method, $middleware);
        }
    }

    /**
     * Define PATCH Route
     *
     * Defines a route for the PATCH HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param string $path The URL path pattern for the route
     * @param callable|string $handler The name of the controller class handling the route
     * @param string|null $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function patch(string $path, callable|string $handler, ?string $method, array $middleware = []): void
    {
        $route = self::getInstance();

        if (is_callable($handler)) {
            // Handle the case where $handler is a callable (function)
            $route->addRoute('PATCH', $path, $handler, null, $middleware);
        } else {
            // Handle the case where $handler is a controller class
            $route->addRoute('PATCH', $path, $handler, $method, $middleware);
        }
    }

    /**
     * Define OPTIONS Route
     *
     * Defines a route for the OPTIONS HTTP method with the specified path, controller, method, and optional middleware.
     *
     * @param array $methods
     * @param string $path The URL path pattern for the route
     * @param callable|string $handler The name of the controller class handling the route
     * @param string|null $method
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function match(array $methods, string $path, callable|string $handler, ?string $method = null, array $middleware = []): void
    {
        $route = self::getInstance();

        foreach ($methods as $httpMethod) {
            $httpMethod = strtoupper($httpMethod);

            // Check if there are specific middleware for this HTTP method
            $methodMiddleware = $middleware[$httpMethod] ?? [];

            if (is_callable($handler)) {
                // Handle the case where $handler is a callable (function)
                $route->addRoute($httpMethod, $path, $handler, null, $methodMiddleware);
            } else {
                // Handle the case where $handler is a controller class
                $route->addRoute($httpMethod, $path, $handler, $method, $methodMiddleware);
            }
        }
    }


    /**
     * Add Route
     *
     * Adds a route with the specified method, path, controller, method, and optional middleware.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE, etc.)
     * @param string $path The URL path pattern for the route
     * @param string|callable $controller The name of the controller class handling the route
     * @param string|null $methodController The name of the method within the controller class
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    protected function addRoute(string $method, string $path, string|callable $controller, ?string $methodController, array $middleware = []): void
    {
        // Concatenate route path with group prefix, if exists
        $prefix = $this->prefix ?? '';
        $path = $path === '/' || $path === '' ? '' : ltrim($path, '/');
        $fullPath = rtrim($prefix, '/') . ($path ? '/' . $path : '');
        $fullPath = $fullPath === '' ? '/' : $fullPath;

        // Register the route with the application server
        lumenity::add($method, $fullPath, $controller, $methodController, $middleware);
    }
}
