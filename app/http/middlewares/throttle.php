<?php

namespace Lumenity\Framework\app\http\middlewares;

use Exception;
use Lumenity\Framework\config\common\http\Request;
use Lumenity\Framework\config\common\http\Response;
use Lumenity\Framework\config\common\interface\middleware;

/**
 * Limit Middleware
 *
 * This middleware class handles limiting access to certain routes or actions.
 * It is used to implement rate limiting or access control mechanisms.
 */
class throttle implements middleware
{
    /**
     * Execute Before Request Handling
     *
     * This method is executed before handling the incoming request.
     * It can be used to implement logic for limiting access or rate limiting.
     *
     * @param Request $req The incoming HTTP request
     * @param Response $res The HTTP response
     * @return void
     * @throws Exception
     */
    public function before(Request $req, Response $res): void
    {
        // Implement logic for limiting access or rate limiting
        // This method can throw an exception if access is denied
    }
}