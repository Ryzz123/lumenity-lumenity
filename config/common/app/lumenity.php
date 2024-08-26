<?php

namespace Lumenity\Framework\config\common\app;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
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

        $request  = Request::capture();
        $response = new Response();
        $container = Container::getInstance()::$container;

        $path = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if (self::matchRoute($route, $path, $method, $matches)) {
                self::handleRoute($route, $matches, $request, $response, $container);
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
            throw new Exception("Cannot access routes directory: {$routeDir}");
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
     * @param Request $request The current request instance
     * @param Response $response The current response instance
     * @param ioc $container The DI container instance
     * @return void
     * @throws BindingResolutionException
     */
    private static function handleRoute(array $route, array $matches, Request $request, Response $response, ioc $container): void
    {
        foreach ($route['middleware'] as $middleware) {
            $middlewareInstance = $container->make($middleware);
            $middlewareInstance->before($request, $response);
        }

        array_shift($matches);

        if ($route['function'] !== null) {
            $controllerInstance = $container->make($route['controller']);
            call_user_func_array([$controllerInstance, $route['function']], [$request, $response, ...$matches]);
        } else {
            call_user_func($route['controller'], $request, $response, ...$matches);
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
