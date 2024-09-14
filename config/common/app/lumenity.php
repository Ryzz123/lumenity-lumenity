<?php

namespace Lumenity\Framework\config\common\app;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use JetBrains\PhpStorm\NoReturn;
use Lumenity\Framework\config\common\http\Request;
use Lumenity\Framework\config\common\http\Response;
use ReflectionException;
use ReflectionFunction;
use ReflectionMethod;

/**
 * Application Server
 *
 * This class represents the main application server responsible for routing incoming requests
 * to the appropriate controllers and actions based on defined routes.
 */
class lumenity
{
    /** @var array $routes The array containing registered routes */
    private static array $routes = [];

    /**
     * Add a Route
     *
     * Registers a new route with the specified method, path, controller, function, and optional middleware.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE, etc.)
     * @param string $path The URL path pattern for the route
     * @param string|callable $controller The name of the controller class or callable handling the route
     * @param string|null $function The name of the function or method within the controller class (optional)
     * @param array $middleware An array of middleware classes to be executed before handling the route (optional)
     * @return void
     */
    public static function add(string $method, string $path, string|callable $controller, ?string $function = null, array $middleware = []): void
    {
        self::$routes[] = [
            'method'     => $method,
            'path'       => $path,
            'controller' => $controller,
            'function'   => $function,
            'middleware' => $middleware
        ];
    }

    /**
     * Run the Application
     *
     * Handles incoming requests by matching them against registered routes
     * and executing the appropriate controller action.
     *
     * @throws Exception If an error occurs during the routing process
     * @return void
     */
    public static function run(): void
    {
        self::loadRoutes();
        $path = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if (self::matchRoute($route, $path, $method, $matches)) {
                self::handleRoute($route, $matches);
                return;
            }
        }

        self::handleNotFound();
    }

    /**
     * Load all route files from the routes directory
     *
     * @return void
     * @throws Exception
     */
    private static function loadRoutes(): void
    {
        $routeDir = __DIR__ . '/../../../routes';

        if (is_dir($routeDir) && is_readable($routeDir)) {
            $routes = glob($routeDir . '/*.php');

            foreach ($routes as $route) {
                require $route;
            }
        } else {
            throw new Exception("Cannot access routes directory: $routeDir");
        }
    }

    /**
     * Match the current request with a registered route
     *
     * @param array $route The registered route to match against
     * @param string $path The requested path
     * @param string $method The HTTP method used for the request
     * @param array|null $matches Matched parameters from the route
     * @return bool Whether the route matches the request
     */
    private static function matchRoute(array $route, string $path, string $method, ?array &$matches): bool
    {
        $dynamicPath = preg_replace('/\{[a-zA-Z0-9-]+\}/', '([a-zA-Z0-9-]+)', $route['path']);
        $regex = '/^' . str_replace('/', '\/', $dynamicPath) . '$/';

        return preg_match($regex, $path, $matches) && $method === $route['method'];
    }

    /**
     * Handle a matched route
     *
     * @param array $route The matched route
     * @param array $matches The matched parameters from the route
     * @return void
     * @throws BindingResolutionException
     * @throws ReflectionException
     */
    private static function handleRoute(array $route, array $matches): void
    {
        $req = ioc('req');
        $res = ioc('res');
        foreach ($route['middleware'] as $middleware) {
            $middlewareInstance = ioc($middleware);
            $middlewareInstance->before($req, $res);
        }

        array_shift($matches);

        if ($route['function'] !== null) {
            $controllerInstance = ioc($route['controller']);
            self::handler([$controllerInstance, $route['function']], $matches, $req, $res);
        } else {
            self::handler($route['controller'], $matches, $req, $res);
        }
    }

    /**
     * Handles the execution of a route handler.
     *
     * This method is responsible for executing the handler of a matched route.
     * The handler can be either a method of an object or a standalone function/closure.
     * The method also handles the injection of dependencies into the handler.
     *
     * @param callable|array $handler The handler of the route. Can be an array (object and method) or a callable (function/closure).
     * @param array $matches The matched parameters from the route.
     * @param Request $request The current request object.
     * @param Response $response The current response object.
     * @return void The result of the handler execution.
     * @throws ReflectionException|BindingResolutionException If the class does not exist, the class does not have the method, or if the function does not exist.
     */
    private static function handler(callable|array $handler, array $matches, Request $request, Response $response): void
    {
        if (is_array($handler)) {
            // Handler is an array (object and method)
            list($object, $method) = $handler;
            $reflection = new ReflectionMethod($object, $method);
        } else {
            // Handler is a Closure or function
            $reflection = new ReflectionFunction($handler);
        }

        $parameters = $reflection->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $paramType = $parameter->getType();
            $paramName = $parameter->getName();
            if ($paramType && !$paramType->isBuiltin()) {
                // If the parameter type is a class, create an instance of it
                $className = $paramType->getName();
                $dependencies[] = ioc($className);
            } elseif ($paramName === 'req' || $paramName === 'request') {
                // If the parameter name is 'req', pass the request
                $dependencies[] = $request;
            } elseif ($paramName === 'res' || $paramName === 'response') {
                // If the parameter name is 'res', pass the response
                $dependencies[] = $response;
            } else {
                // Otherwise, pass the matched parameters from the route
                $dependencies[] = array_shift($matches);
            }
        }

        // Call method or closure
        if (isset($object)) {
            $reflection->invokeArgs($object, $dependencies);
        } else {
            $reflection->invokeArgs($dependencies);
        }
    }

    /**
     * Handle a 404 Not Found error
     *
     * @return void
     * @throws Exception
     */
    #[NoReturn] private static function handleNotFound(): void
    {
        view('error', [
            'title'   => '404 | PAGE NOT FOUND',
            'code'    => '404',
            'message' => 'NOT FOUND'
        ]);
    }
}
