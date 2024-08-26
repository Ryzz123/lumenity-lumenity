<?php

namespace Lumenity\Framework\app\http\middlewares;

use Illuminate\Http\Request;
use Lumenity\Framework\config\common\http\Response;
use Lumenity\Framework\config\common\interface\Middleware;

/**
 * JSON Middleware
 *
 * This middleware class handles setting the response content type to JSON.
 * It ensures that the response returned by the application is in JSON format.
 */
class json implements Middleware
{
    /**
     * Set Response Content Type to JSON
     *
     * This method is executed before handling the incoming request.
     * It sets the 'Content-Type' header of the response to 'application/json'.
     *
     * @param Request $req The incoming HTTP request
     * @param Response $res The HTTP response
     * @return void
     */
    public function before(Request $req, Response $res): void
    {
        $res->headers->set('Content-Type', 'application/json');
    }
}