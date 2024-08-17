<?php

namespace Lumenity\Framework\routes;

use Illuminate\Http\Request;
use Lumenity\Framework\config\common\app\route as Route;
use Lumenity\Framework\config\common\http\Response;

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
        Route::get('/', function (Request $req, Response $res) {
            $res::view('welcome', [
                'title' => 'Welcome to Lumenity Framework',
                'content' => 'This is a simple PHP framework for building web applications.'
            ]);
        });
    }
}
