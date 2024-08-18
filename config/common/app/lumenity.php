<?php

namespace Lumenity\Framework\config\common\app;

use Exception;
use Illuminate\Http\Request;
use Lumenity\Framework\config\common\http\Response;
use Lumenity\Framework\config\common\utils\container;

/**
 * Application Server
 *
 * This class represents the main application server responsible for routing incoming requests
 * to the appropriate controllers and actions based on defined routes.
 */
class lumenity
{
    /** @var array The array containing registered routes */
    private static array $routes = [];

    /**
     * Add Route
     *
     * Registers a new route with the specified method, path, controller, function, and optional middleware.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE, etc.)
     * @param string $path The URL path pattern for the route
     * @param string|callable $controller The name of the controller class handling the route
     * @param string|null $function The name of the function or method within the controller class
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function add(string $method, string $path, string|callable $controller, ?string $function, array $middleware = []): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware
        ];
    }

    /**
     * Run Application
     *
     * Handles incoming requests by matching them against registered routes
     * and executing the appropriate controller action.
     *
     * @throws Exception If an error occurs during the routing process
     * @return void
     */
    public static function run(): void
    {
        // Capture the request and response objects
        $req = Request::capture();
        $res = new Response();

        // Get the container instance
        $container = container::getInstance()::$container;

        // Determine the request path and method
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }
        $method = $_SERVER['REQUEST_METHOD'];

        // Iterate through registered routes to find a match
        foreach (self::$routes as $route) {
            // Convert the route path to a regular expression
            $dynamicPath = preg_replace('/\{[a-zA-Z0-9-]+\}/', '([a-zA-Z0-9-]+)', $route['path']);
            $regex = '/^' . str_replace('/', '\/', $dynamicPath) . '$/';

            // Check if the current route matches the request path and method
            if (preg_match($regex, $path, $matches) && $method == $route['method']) {
                // Execute middleware before handling the route
                // Middleware classes are executed in the order they are defined
                foreach ($route['middleware'] as $middleware) {
                    $instance = $container->make($middleware);
                    $instance->before($req, $res);
                }

                // Extract route parameters from the path
                array_shift($matches);

                // Call the controller action
                if (isset($route['function'])) {
                    // If the controller is a class name, create an instance of the class
                    $controllerInstance = $container->make($route['controller']);
                    $function = $route['function'];
                    call_user_func_array([$controllerInstance, $function], [$req, $res, ...$matches]);
                } else {
                    // If the controller is a callable function, call the function directly
                    call_user_func($route['controller'], $req, $res, ...$matches);
                }
                return;
            }
        }

        // If no matching route is found, render a 404 error page
        $res::view('error', [
            'title' => '404 | PAGE NOT FOUND',
            'code' => '404',
            'message' => "NOT FOUND"
        ]);
    }
}
