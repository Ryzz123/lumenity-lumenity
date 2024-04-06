<?php

namespace Lumenity\Framework\routes;

use Lumenity\Framework\app\http\controllers\WelcomeController;
use Lumenity\Framework\config\common\app\route as Route;

/**
 * Website Routes
 *
 * This class handles the definition of routes specific to the website.
 */
class web
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
        // Define website routes here

        Route::group('', function () {
            Route::get('/', WelcomeController::class, 'index');
        });
    }
}
