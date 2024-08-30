<?php

namespace Lumenity\Framework\config\common\blade;

class vite
{
    /**
     * Generate link and script tags for the provided entrypoints.
     *
     * @param array $entrypoints The entrypoints to generate tags for.
     * @return string The generated link and script tags.
     */
    public static function capture(array $entrypoints): string
    {
        // Define the Vite development server URL. If the 'VITE_APP_URL' environment variable is not set,
        // it defaults to 'http://localhost:5173'.
        $viteUrl = $_ENV['VITE_APP_URL'] ?? 'http://localhost:5173';

        // Ensure entrypoints is an array
        $entrypoints = is_array($entrypoints) ? $entrypoints : [$entrypoints];

        // Initialize arrays to hold the generated link and script tags
        $links = [];
        $scripts = [];

        // Iterate over each entrypoint
        foreach ($entrypoints[0] as $entrypoint) {
            // Determine the type of the entrypoint based on the file extension
            $extension = pathinfo($entrypoint, PATHINFO_EXTENSION);

            // If the 'APP_DEBUG' environment variable is set to 'true', the application is in development mode.
            // In this case, the assets are served from the Vite development server.
            if ($_ENV['APP_DEBUG'] === 'true') {
                // Sanitize the Vite development server URL and the entrypoint to prevent XSS attacks.
                $safeViteUrl = htmlspecialchars($viteUrl, ENT_QUOTES, 'UTF-8');
                $safeEntryPoint = htmlspecialchars($entrypoint, ENT_QUOTES, 'UTF-8');
                $url = "$safeViteUrl$safeEntryPoint";

                // Generate link or script tags based on the file type
                if ($extension === 'css') {
                    $links[] = "<link rel='stylesheet' href='$url' type='text/css' />";
                } elseif ($extension === 'js') {
                    $scripts[] = "<script src='$url' defer></script>";
                }
            } else {
                // If the 'APP_DEBUG' environment variable is not set to 'true', the application is in production mode.
                // In this case, the assets are served from the application server.

                // Sanitize the entrypoint to prevent XSS attacks and remove the 'resources/' prefix.
                $safePath = htmlspecialchars($entrypoint, ENT_QUOTES, 'UTF-8');
                $safePath = str_replace('resources/', '', $safePath);

                // Generate link or script tags based on the file type
                if ($extension === 'css') {
                    $links[] = "<link rel='stylesheet' href='$safePath' type='text/css' />";
                } elseif ($extension === 'js') {
                    $scripts[] = "<script src='$safePath' defer></script>";
                }
            }
        }

        // Return all generated tags as a single string
        return implode("\n", array_merge($links, $scripts));
    }
}