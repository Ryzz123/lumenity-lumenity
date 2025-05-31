<?php

namespace Lumenity\Framework\app\http\middlewares;

use Exception;
use Lumenity\Framework\config\common\http\Request;
use Lumenity\Framework\config\common\http\Response;
use Lumenity\Framework\config\common\interface\middleware;

/**
 * CSRF Middleware
 *
 * This middleware class handles Cross-Site Request Forgery (CSRF) protection.
 * It verifies the validity of CSRF tokens in incoming requests.
 */
class csrf implements middleware
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
        $token = $_COOKIE['XSRF-TOKEN'] ?? null;

        /**
         * Validate CSRF Token
         * If the CSRF token is missing or invalid, render an error view.
         */
        if (!$req->input('_token') || $req->input('_token') !== $token) {
            // If CSRF token is missing or invalid, render an error view
            $res->headers->set('Content-Type', 'application/json');
            $parsed_url = parse_url($req->url());
            $base_url = $parsed_url['scheme'] . '://' . $parsed_url['host'];
            if (!empty($parsed_url['port']) && $parsed_url['port'] != 80 && $parsed_url['port'] != 443) {
                $base_url .= ':' . $parsed_url['port'];
            }
            $base_url .= '/';
            logger('Invalid CSRF token', 'error', [
                'url' => $req->url(),
                'method' => $req->method(),
                'token' => $req->input('_token'),
                'cookie_token' => $token,
            ]);
            if ($base_url == config('app.url')) {
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