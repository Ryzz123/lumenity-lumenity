<?php

namespace Lumenity\Framework\common\config\handler;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Debug Handler Configuration
 *
 * This class handles the capture and configuration of debug handlers for displaying
 * detailed error pages during development.
 */
class DebugHandler
{
    /**
     * Capture Debug Information
     *
     * Initializes and configures the debug handler to capture detailed error information
     * and display pretty error pages during development.
     *
     * @return void
     */
    public static function capture(): void
    {
        // Create a new instance of Whoops Run
        $whoops = new Run;

        // Push the PrettyPageHandler to display formatted error pages
        $whoops->pushHandler(new PrettyPageHandler);

        // Register Whoops as the global PHP error and exception handler
        $whoops->register();
    }
}
