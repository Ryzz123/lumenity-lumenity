<?php

namespace Lumenity\Framework\server;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Lumenity\Framework\Common\Config\App\view;

/**
 * Application Server
 *
 * This class represents the main application server responsible for routing incoming requests
 * to the appropriate controllers and actions based on defined routes.
 */
class App
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
     * @param string $controller The name of the controller class handling the route
     * @param string $function The name of the function or method within the controller class
     * @param array $middleware An array of middleware classes to be executed before handling the route
     * @return void
     */
    public static function add(string $method, string $path, string $controller, string $function, array $middleware = []): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'Controller' => $controller,
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

        // Determine the request path and method
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }
        $method = $_SERVER['REQUEST_METHOD'];

        // Iterate through registered routes to find a match
        foreach (self::$routes as $route) {
            $dynamicPath = preg_replace('/\{[a-zA-Z0-9]+\}/', '([a-zA-Z0-9]+)', $route['path']);
            $regex = '/^' . str_replace('/', '\/', $dynamicPath) . '$/';

            // Check if the current route matches the request path and method
            if (preg_match($regex, $path, $matches) && $method == $route['method']) {
                // Execute middleware before handling the route
                foreach ($route['middleware'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before($req, $res);
                }

                // Extract route parameters from the path
                array_shift($matches);

                // Call the controller action
                if (isset($route['function'])) {
                    $controller = new $route['Controller'];
                    $function = $route['function'];
                    call_user_func_array([$controller, $function], [$req, $res, ...$matches]);
                } else {
                    // If no controller action is defined, return a 404 error
                    http_response_code(404);
                    echo "Not Found";
                }
                return;
            }
        }

        // If no matching route is found, render a 404 error page
        view::render('missing', [
            'title' => '404 | PAGE NOT FOUND',
            'code' => '404',
            'message' => "NOT FOUND"
        ]);
    }
}
