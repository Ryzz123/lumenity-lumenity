<?php

namespace Lumenity\Framework\config\common\app;

use Exception;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Debug Handler Configuration
 *
 * This class handles the capture and configuration of debug handlers for displaying
 * detailed error pages during development.
 */
class whoops
{
    /**
     * Capture Debug Information
     *
     * Initializes and configures the debug handler to capture detailed error information
     * and display pretty error pages during development.
     *
     * @return void
     * @throws Exception
     */
    public static function capture(): void
    {
        // Create a new instance of Whoops Run
        $whoops = new Run;

        // Create and configure the PrettyPageHandler
        $handler = tap(new PrettyPageHandler, function (PrettyPageHandler $handler) {
            // Set the title for the error page
            $handler->setPageTitle('Lumenity Framework Error');
            // Add a resource path for additional assets
            $handler->addResourcePath(realpath(__DIR__ . '/../../../public'));
            // Add a custom CSS file for styling the error page
            $handler->addCustomCss('/css/root/whoops.custom.css');
            // Add custom data table for framework information
            $handler->addDataTable('Lumenity Framework', [
                'Version' => '4.0.0'
            ]);
        });

        // Push the configured handler to the Whoops stack
        if ($_ENV['APP_DEBUG'] === 'true' && $_ENV['APP_MODE'] === 'development') {
            $whoops->pushHandler($handler);
        } else {
            view::render('error', [
                'title' => '500 | ERROR 500',
                'code' => '500',
                'message' => "Error 500: Internal Server Error",
            ]);
        }


        // Register Whoops error handler
        $whoops->register();
    }
}
