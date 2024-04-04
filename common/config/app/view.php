<?php

namespace Lumenity\Framework\common\config\app;

use eftec\bladeone\BladeOne;
use Exception;

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
        // Set the paths for view templates and cache
        $views = self::$viewsPath;
        $cache = self::$cachePath;

        // Create a new BladeOne instance
        $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

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
    public static function redirect(string $url): void
    {
        // Perform HTTP redirect to the specified URL
        header("Location: " . $url);

        // Terminate script execution
        exit();
    }
}
