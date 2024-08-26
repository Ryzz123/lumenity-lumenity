<?php

// Import the View class from the Lumenity Framework
use JetBrains\PhpStorm\NoReturn;
use Lumenity\Framework\config\common\app\log as Log;
use Lumenity\Framework\config\common\app\view as View;

// Check if the function 'view' already exists
if (!function_exists('view')) {
    /**
     * Render a view with the given data.
     *
     * This function uses the View class from the Lumenity Framework to render a view.
     * After rendering the view, it terminates the script execution.
     *
     * @param string $view The name of the view to render.
     * @param array $data The data to pass to the view. Default is an empty array.
     *
     * @return void
     * @throws Exception
     */
    #[NoReturn] function view(string $view, array $data = []): void
    {
        // Render the view with the given data
        View::render($view, $data);
        // Terminate the script execution
        exit();
    }
}

// Check if the function 'redirect' already exists
if (!function_exists('redirect')) {
    /**
     * Redirect to the given URL.
     *
     * This function uses the View class from the Lumenity Framework to perform a redirect.
     * After performing the redirect, it terminates the script execution.
     *
     * @param string $url The URL to redirect to.
     *
     * @return void
     */
    function redirect(string $url): void
    {
        // Perform the redirect
        View::redirect($url);
    }
}

// Check if the function 'logger' already exists
if (!function_exists('logger')) {
    /**
     * Log a message with the given type.
     *
     * This function uses the Log class from the Lumenity Framework to log a message.
     * The type of the log message can be one of the following: 'info', 'warning', 'error', 'debug', 'critical'.
     * If no type is provided, it defaults to 'info'.
     *
     * @param string $message The message to log.
     * @param string $type The type of the log message. Default is 'info'.
     *
     * @return void
     */
    function logger(string $message, string $type = 'info'): void
    {
        switch ($type) {
            case 'info':
                // Log the message as an info message
                Log::info($message);
                break;
            case 'warning':
                // Log the message as a warning message
                Log::warning($message);
                break;
            case 'error':
                // Log the message as an error message
                Log::error($message);
                break;
            case 'debug':
                // Log the message as a debug message
                Log::debug($message);
                break;
            case 'critical':
                // Log the message as a critical message
                Log::critical($message);
                break;
        }
    }
}