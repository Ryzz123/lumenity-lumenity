<?php

namespace Lumenity\Framework\app\http\middlewares;

use Exception;
use Lumenity\Framework\config\common\http\Request;
use Lumenity\Framework\config\common\app\view;
use Lumenity\Framework\config\common\http\Response;
use Lumenity\Framework\config\common\interface\Middleware;

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
            $parsed_url = parse_url($req->url());
            $base_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . ':' . $parsed_url['port'] . '/';
            if ($base_url == $_ENV['APP_URL']) {
                view('error', [
                    'title' => '500 | ERROR 500',
                    'code' => '500',
                    'message' => "Error 500: Internal Server Error",
                ]);
            } else {
                $res->setContent(['error' => 'Invalid CSRF token'])
                    ->setStatusCode(403)
                    ->send();
            }
            exit();
        }
    }
}