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
            $handler->addResourcePath(realpath(__DIR__ . '/../utils'));
            // Add a custom CSS file for styling the error page
            $handler->addCustomCss('/root/whoops.custom.css');
            // Add custom data table for framework information
            $handler->addDataTable('Lumenity Framework', [
                'Version' => '6.1.0'
            ]);

            $handler->setEditor(config('app.editor') ?: 'vscode');
        });

        // Push the configured handler to the Whoops stack
        if (config('app.debug') === 'true') {
            $whoops->pushHandler($handler);
        } else {
            $whoops->pushHandler(function ($exception) {
                logger($exception->getMessage(), 'debug', [
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'trace' => $exception->getTraceAsString()
                    ]
                );
                view('error', [
                    'title' => '500 | ERROR 500',
                    'code' => '500',
                    'message' => "Error 500: Internal Server Error",
                ]);
            });
        }


        // Register Whoops error handler
        $whoops->register();
    }
}
