<?php

namespace Lumenity\Framework\app\http\middlewares;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lumenity\Framework\common\config\app\cors as CorsConfig;

/**
 * CORS Middleware
 *
 * This middleware class handles Cross-Origin Resource Sharing (CORS) for incoming requests.
 * It sets the appropriate CORS headers based on the configuration defined in the CorsConfig class.
 */
class cors implements Middleware
{
    /**
     * Handle Before Request
     *
     * This method is executed before handling the incoming request.
     * It sets the appropriate CORS headers based on the CORS configuration.
     *
     * @param Request $req The incoming HTTP request
     * @param Response $res The HTTP response
     * @return void
     */
    public function before(Request $req, Response $res): void
    {
        // Get CORS configuration
        $corsConfig = CorsConfig::enable();

        // Set CORS headers
        foreach ($corsConfig as $key => $value) {
            if ($key === 'allowed_methods') {
                $res->headers->set('Access-Control-Allow-Methods', implode(', ', $value));
            } elseif ($key === 'allowed_origins') {
                $res->headers->set('Access-Control-Allow-Origin', implode(', ', $value));
            } elseif ($key === 'allowed_headers') {
                $res->headers->set('Access-Control-Allow-Headers', implode(', ', $value));
            } elseif ($key === 'exposed_headers') {
                $res->headers->set('Access-Control-Expose-Headers', implode(', ', $value));
            } elseif ($key === 'max_age') {
                $res->headers->set('Access-Control-Max-Age', $value);
            } elseif ($key === 'supports_credentials' && $value) {
                $res->headers->set('Access-Control-Allow-Credentials', 'true');
            }
        }
    }
}