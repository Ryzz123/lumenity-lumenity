<?php

namespace Lumenity\Framework\app\http\middlewares;
use Lumenity\Framework\config\common\http\Request;
use Lumenity\Framework\config\common\app\log as Log;
use Lumenity\Framework\config\common\http\Response;
use Lumenity\Framework\config\common\interface\middleware;

/**
* Logger Middleware
*
 * This middleware class handles logging incoming requests.
 * It logs details such as request method, request URI, client IP, and timestamp.
 */
class logger implements middleware
{
    /**
     * Log Incoming Request
     *
     * This method is executed before handling the incoming request.
     * It logs details about the incoming request, such as request method,
     * request URI, client IP, and timestamp.
     *
     * @param Request $req The incoming HTTP request
     * @param Response $res The HTTP response
     * @return void
     */
    public function before(Request $req, Response $res): void
    {
        // Log details of the incoming request
        date_default_timezone_set('Asia/Jakarta');
        Log::info("Request received: " . $req->getMethod() . " " . $req->getRequestUri() . " from " . $req->getClientIp() . " at " . date('Y-m-d H:i:s'));
    }
}