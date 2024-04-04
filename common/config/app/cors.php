<?php

namespace Lumenity\Framework\common\config\app;

/**
 * Cross-Origin Resource Sharing (CORS) Configuration
 *
 * This class provides methods to configure Cross-Origin Resource Sharing (CORS) for the application
 * by defining the allowed paths, methods, origins, headers, and other CORS settings.
 */
class cors
{
    /**
     * Enable CORS
     *
     * This method enables Cross-Origin Resource Sharing (CORS) for the application
     * by configuring the CORS settings.
     *
     * @return array The CORS configuration settings
     */
    public static function enable(): array
    {
        return [
            'allowed_methods' => ['*'],

            'allowed_origins' => ['*'],

            'allowed_origins_patterns' => [],

            'allowed_headers' => ['*'],

            'exposed_headers' => [],

            'max_age' => 0,

            'supports_credentials' => false,
        ];
    }
}