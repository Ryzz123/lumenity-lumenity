<?php

namespace Lumenity\Framework\config\common\app;

use eftec\bladeone\BladeOne;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Lumenity\Framework\config\common\blade\vite;
use Lumenity\Framework\config\common\blade\asset;

/**
 * View Configuration
 *
 * This class handles rendering views and managing view-related operations such as rendering templates
 * and performing redirects.
 */
class view
{
    /** @var string The path to the directory containing view templates */
    public static string $viewsPath = __DIR__ . '/../../../resources/views';

    /** @var string The path to the cache directory for compiled view templates */
    public static string $cachePath = __DIR__ . '/../../../storage/framework/views';
    /** @var view|null The singleton instance of the view class */
    private static ?view $instance = null;
    public BladeOne $blade;

    /**
     * Constructor
     *
     * Initializes the view instance.
     */
    private function __construct()
    {
        $this->blade = new BladeOne(self::$viewsPath, self::$cachePath, BladeOne::MODE_AUTO);
    }

    /**
     * @return view
     *
     * Get Instance
     *
     * Returns the singleton instance of the view class.
     */
    public static function getInstance(): view
    {
        if (self::$instance === null) {
            self::$instance = new view();
        }
        return self::$instance;
    }

    /**
     * Render View
     *
     * Renders a view template with the provided data.
     *
     * @param string $view The name of the view template to render
     * @param array $data An associative array of data to pass to the view template
     * @return void
     * @throws Exception
     */
    public static function render(string $view, array $data = []): void
    {
        /**
         * Get Blade Instance
         */
        $blade = self::getInstance()->blade;

        // it's a way to generate the csrf token (if it's not generated yet)
        $token = $blade->getCsrfToken(true);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = $token;
        }

        // Set the CSRF token in the Blade instance
        $blade->csrf_token = $_SESSION['csrf_token'];
        setcookie('XSRF-TOKEN', $blade->csrf_token, time() + 60 * 60 * 24 * 365, '/');

        // Enable including the scope in the view templates
        $blade->includeScope = true;

        // Set the compiled flag based on the application environment
        $blade->setIsCompiled(config('app.debug') === 'false');

        // Set the inject resolver to resolve dependencies from the container
        $blade->setInjectResolver(function ($name) {
            return ioc($name);
        });

        // Add the 'asset' runtime function to the Blade instance
        foreach (asset::capture() as $key => $value) {
           $blade->addAssetDict($key, $value);
        }

        // Add the 'vite' runtime function to the Blade instance
        $blade->addMethod('runtime', 'vite', function ($entrypoints) {
            return vite::capture($entrypoints);
        });

        // Render the view template and output the result
        echo $blade->run($view, $data);
    }

    /**
     * Redirect to URL
     *
     * Performs a HTTP redirect to the specified URL.
     *
     * @param string $url The URL to redirect to
     * @return void
     */
    #[NoReturn] public static function redirect(string $url): void
    {
        // Perform HTTP redirect to the specified URL
        header("Location: " . $url);

        // Terminate script execution
        exit();
    }
}
