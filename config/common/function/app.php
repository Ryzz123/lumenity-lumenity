<?php

// Import the View class from the Lumenity Framework
use Illuminate\Contracts\Container\BindingResolutionException;
use JetBrains\PhpStorm\NoReturn;
use Lumenity\Framework\config\common\app\log as Log;
use Lumenity\Framework\config\common\app\view as View;
use Lumenity\Framework\config\common\app\validator;
use Lumenity\Framework\config\common\utils\container;

// Check if the function 'ioc' already exists
if (!function_exists('ioc')) {
    /**
     * Get the instance of the ioc class.
     *
     * This function returns the instance of the ioc class, which is used to manage the dependency injection ioc.
     *
     * @throws BindingResolutionException
     */
    function ioc(string $abstract)
    {
        return container::getInstance()::$container->make($abstract);
    }
}

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

// Check if the function 'config' already exists
if (!function_exists('config')) {
    /**
     * Get the value of a configuration setting.
     *
     * This function retrieves the value of a configuration setting from the loaded configuration array.
     *
     * @param string $key The key of the configuration setting, in dot notation (e.g., 'app.version').
     *
     * @return mixed|null The value of the configuration setting, or null if the key does not exist.
     * @throws RuntimeException If the configuration file cannot be loaded.
     */
    function config(string $key): mixed
    {
        static $config_file = null;

        if ($config_file === null) {
            $config_path = __DIR__ . '/../../../bootstrap/config.php';

            if (!file_exists($config_path)) {
                throw new RuntimeException("Configuration file not found: $config_path");
            }

            $config_file = require_once $config_path;

            if (!is_array($config_file)) {
                throw new RuntimeException("Invalid configuration file format. Expected an associative array.");
            }
        }

        $keys = explode('.', $key);
        $value = $config_file;

        foreach ($keys as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return null; // Return null if the key does not exist
            }
            $value = $value[$segment];
        }

        return $value;
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
    #[NoReturn] function redirect(string $url): void
    {
        // Perform the redirect
        View::redirect($url);
    }
}

// Check if the function 'validator' already exists
if (!function_exists('validator')) {
    /**
     * Validate the given data against the specified rules.
     *
     * This function uses the validator class from the Lumenity Framework to validate data.
     *
     * @param array $data The data to validate.
     * @param array $rules The validation rules.
     * @param array $message Optional. Custom error messages for validation rules.
     * @return validator True if validation passes, false otherwise.
     */
    function validator(array $data, array $rules, array $message = []): validator
    {
        // Validate the data against the rules
        return validator::make($data, $rules, $message);
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
     * @param array $context
     * @return void
     */
    function logger(string $message, string $type = 'info', array $context = []): void
    {
        switch ($type) {
            case 'info':
                // Log the message as an info message
                Log::info($message, $context);
                break;
            case 'warning':
                // Log the message as a warning message
                Log::warning($message, $context);
                break;
            case 'error':
                // Log the message as an error message
                Log::error($message, $context);
                break;
            case 'debug':
                // Log the message as a debug message
                Log::debug($message, $context);
                break;
            case 'critical':
                // Log the message as a critical message
                Log::critical($message, $context);
                break;
            case 'alert':
                // Log the message as an alert message
                Log::alert($message, $context);
                break;
            case 'emergency':
                // Log the message as an emergency message
                Log::emergency($message, $context);
                break;
            case 'notice':
                // Log the message as a notice message
                Log::notice($message, $context);
        }
    }
}