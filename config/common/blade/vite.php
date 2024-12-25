<?php

namespace Lumenity\Framework\config\common\blade;

use Exception;

class vite
{
    /**
     * Generate link and script tags for the provided entrypoints.
     *
     * @param array $entrypoints The entrypoints to generate tags for.
     * @return string The generated link and script tags.
     * @throws Exception
     */
    public static function capture(array $entrypoints): string
    {
        // Define the Vite development server URL
        // it defaults to 'http://localhost:5173'.
        $hot = file_exists("hot") ? file_get_contents('hot') : 'http://localhost:5173';
        // Replace the '::1' IP address with 'localhost'
        $viteUrl =  str_replace('[::1]', 'localhost', $hot) . '/';

        if (is_string($entrypoints[0])) {
            $extension = pathinfo($entrypoints[0], PATHINFO_EXTENSION);
            // If the 'APP_DEBUG' environment variable is set to 'true', the application is in development mode.
            // In this case, the assets are served from the Vite development server.
            if (config('app.debug') === 'true') {
                // Sanitize the Vite development server URL and the entrypoint to prevent XSS attacks.
                $safeViteUrl = htmlspecialchars($viteUrl, ENT_QUOTES, 'UTF-8');
                $safeEntryPoint = htmlspecialchars($entrypoints[0], ENT_QUOTES, 'UTF-8');
                $url = "$safeViteUrl$safeEntryPoint";

                // Generate link or script tags based on the file type
                if ($extension === 'css') {
                    return "<link rel='stylesheet' href='$url' type='text/css' />";
                } elseif ($extension === 'js') {
                    return "<script type='module' src='$url' defer></script>";
                }
            } else {
                // If the application is not in development mode, the assets are served from the 'build' directory.
                $manifestPath = 'build/manifest.json';
                // Check if the manifest file exists
                if (!file_exists($manifestPath)) {
                    throw new Exception('Manifest file not found.');
                }

                // Load the manifest file
                $manifest = json_decode(file_get_contents($manifestPath), true);
                // Define the entrypoints
                $entry = $manifest[$entrypoints[0]];
                if ($entry['src'] === $entrypoints[0]) {
                    if ($extension === 'css') {
                        return "<link rel='stylesheet' href='build/{$entry['file']}' type='text/css' />";
                    } elseif ($extension === 'js') {
                        return "<script type='module' src='build/{$entry['file']}' defer></script>";
                    }
                }
            }
        }

        // Ensure entrypoints is an array
        $entrypoints = $entrypoints[0];

        // Initialize arrays to hold the generated link and script tags
        $links = [];
        $scripts = [];

        // Iterate over each entrypoint
        foreach ($entrypoints as $entrypoint) {
            // Determine the type of the entrypoint based on the file extension
            $extension = pathinfo($entrypoint, PATHINFO_EXTENSION);

            // If the 'APP_DEBUG' environment variable is set to 'true', the application is in development mode.
            // In this case, the assets are served from the Vite development server.
            if (config('app.debug') === 'true') {
                // Sanitize the Vite development server URL and the entrypoint to prevent XSS attacks.
                $safeViteUrl = htmlspecialchars($viteUrl, ENT_QUOTES, 'UTF-8');
                $safeEntryPoint = htmlspecialchars($entrypoint, ENT_QUOTES, 'UTF-8');
                $url = "$safeViteUrl$safeEntryPoint";

                // Generate link or script tags based on the file type
                if ($extension === 'css') {
                    $links[] = "<link rel='stylesheet' href='$url' type='text/css' />";
                } elseif ($extension === 'js') {
                    $scripts[] = "<script type='module' src='$url' defer></script>";
                }
            } else {
                // If the application is not in development mode, the assets are served from the 'build' directory.
                $manifestPath = 'build/manifest.json';
                // Check if the manifest file exists
                if (!file_exists($manifestPath)) {
                    throw new Exception('Manifest file not found.');
                }

                // Load the manifest file
                $manifest = json_decode(file_get_contents($manifestPath), true);
                // Define the entrypoints
                $entry = $manifest[$entrypoint];
                if ($entry['src'] === $entrypoint) {
                    if ($extension === 'css') {
                        $links[] = "<link rel='stylesheet' href='build/{$entry['file']}' type='text/css' />";
                    } elseif ($extension === 'js') {
                        $scripts[] = "<script type='module' src='build/{$entry['file']}' defer></script>";
                    }
                }
            }
        }

        // Return all generated tags as a single string
        return implode("\n", array_merge($links, $scripts));
    }
}