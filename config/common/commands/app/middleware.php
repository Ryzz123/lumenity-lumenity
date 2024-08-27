<?php

namespace Lumenity\Framework\config\common\commands\app;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Middleware Command
 *
 * This command creates a new middleware in the application.
 */
class middleware implements command
{
    /**
     * Create
     *
     * This method creates a new middleware in the application.
     *
     * @param App $app
     * @param string|null $name
     * @param string|null $config
     * @return void
     */
    public function create(App $app, ?string $name, ?string $config): void
    {
        if (!$name) {
            $app->writeln("Name is required.");
            return;
        }

        // Extract namespace and controller name from the provided name
        $nameParts = explode('/', $name);
        $namespace = 'Lumenity\\Framework\\app\\http\\middlewares';
        $middleware = $nameParts[count($nameParts) - 1];

        // Create directory structure for the middleware if it doesn't exist
        $namespaceDir = implode('\\', array_slice($nameParts, 0, -1));
        if ($namespaceDir) {
            $namespaceDir = "\\$namespaceDir";
        }

        $middlewareDir = "app/http/middlewares/$namespaceDir";
        if (!is_dir($middlewareDir)) {
            mkdir($middlewareDir, 0777, true);
        }

        // Check if middleware file already exists
        $middlewareFile = "$middlewareDir/$middleware.php";
        if (file_exists($middlewareFile)) {
            $app->writeln("Middleware $middleware already exists.");
            return;
        }

        // Generate middleware template
        $template = <<<EOT
        <?php
        
        namespace $namespace$namespaceDir;
        
        use Illuminate\Http\Request;
        use Lumenity\Framework\config\common\http\Response;
        use Lumenity\Framework\config\common\interface\Middleware;
        
        class $middleware implements Middleware
        {
            public function before(Request \$req, Response \$res): void
            {
                // Middleware logic here
            }
        }
        EOT;

        // Write the template to the middleware file
        file_put_contents($middlewareFile, $template);

        $app->writeln("Middleware $middleware created successfully.");
    }
}