<?php

// Namespace declaration for the class
namespace Lumenity\Framework\config\common\blade;

/**
 * Class asset
 *
 * This class is used to manage the assets of the application.
 * It provides a method to capture the assets and their corresponding URLs.
 */
class asset
{
    /**
     * The capture method
     *
     * This method returns an associative array where the keys are the paths of the assets
     * and the values are the URLs where these assets can be found.
     *
     * @return array An associative array of assets and their URLs
     */
    public static function capture(): array
    {
        return [
            'js/jquery.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js',
            'js/alpine.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.14.1/cdn.min.js',
        ];
    }
}