<?php

namespace Lumenity\Framework\config\common\app;

use eftec\bladeone\BladeOne;
use Exception;
use JetBrains\PhpStorm\NoReturn;

/**
 * View Configuration
 *
 * This class handles rendering views and managing view-related operations such as rendering templates
 * and performing redirects.
 */
class view
{
    /** @var string The path to the directory containing view templates */
    protected static string $viewsPath = __DIR__ . '/../../../resources/views';

    /** @var string The path to the cache directory for compiled view templates */
    protected static string $cachePath = __DIR__ . '/../../../bootstrap/cache';
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
        session_start();
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

        // Render the view template and output the result
        // Enable including the scope in the view templates
        $blade->getCsrfToken(); // it's a way to generate the csrf token (if it's not generated yet)

        // Enable including the scope in the view templates
        $blade->includeScope = true;

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
