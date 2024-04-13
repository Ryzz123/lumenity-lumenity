<?php

namespace Lumenity\Framework\routes;

use Lumenity\Framework\app\http\controllers\WelcomeController;
use Lumenity\Framework\app\http\middlewares\json;
use Lumenity\Framework\app\http\middlewares\logger;
use Lumenity\Framework\app\http\middlewares\limit;
use Lumenity\Framework\config\common\app\route as Route;

/**
 * Api Routes
 *
 * This class handles the definition of routes specific to the website.
 */
class api
{
    /**
     * Capture Website Routes
     *
     * This method captures and defines the routes for the website.
     * It should be called to register website-specific routes.
     *
     * @return void
     */
    public static function capture(): void
    {
        // Define API routes here
        Route::group('/api', function () {
            Route::get('/health-check', WelcomeController::class, 'healthCheck', [limit::class, json::class, logger::class]);
        });
    }
}