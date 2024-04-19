<?php

namespace Lumenity\Framework\app\http\middlewares;

use Exception;
use Illuminate\Http\Request;
use Lumenity\Framework\config\common\app\view;
use Lumenity\Framework\config\common\http\Response;

/**
 * CSRF Middleware
 *
 * This middleware class handles Cross-Site Request Forgery (CSRF) protection.
 * It verifies the validity of CSRF tokens in incoming requests.
 */
class csrf implements Middleware
{
    /**
     * Handle Incoming Request
     *
     * This method is executed before handling the incoming request.
     * It starts a session and validates the CSRF token.
     * If the token is missing or invalid, it renders an error view.
     *
     * @param Request $req The incoming HTTP request
     * @param Response $res The HTTP response
     * @throws Exception if the CSRF token is missing or invalid
     */
    public function before(Request $req, Response $res): void
    {
        /**
         * Get Blade Instance
         * This is used to validate the CSRF token.
         */
        $blade = view::getInstance()->blade;

        /**
         * Validate CSRF Token
         * If the CSRF token is missing or invalid, render an error view.
         */
        if (!$req->input('_token') || $blade->csrfIsValid() !== true) {
            // If CSRF token is missing or invalid, render an error view
            $res->headers->set('Content-Type', 'application/json');
            $res->setContent(['error' => 'Invalid CSRF token'])
                ->setStatusCode(403)
                ->send();
        }
    }
}