<?php

namespace Lumenity\Framework\config\common\commands\app;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Controller Command Class
 *
 * This class implements the command interface and provides a method to create a new controller in the Lumenity Framework.
 * It creates a new controller file with the specified name and namespace, along with a basic controller structure.
 */
class controller implements command
{

    /**
     * Create
     *
     * This method creates a new middleware in the application.
     *
     * @param App $app
     * @param array $args
     * @param array $option
     * @return void
     */
    public function create(App $app, array $args, array $option): void
    {
        // Get the name of the controller from the command arguments
        $name = $args['name'] ?? null;
        if (!$name) {
            $app->writeln("Name is required.");
            return;
        }

        // Extract namespace and controller name from the provided name
        $nameParts = explode('/', $name);
        $namespace = 'Lumenity\\Framework\\app\\http\\controllers';
        $controller = ucfirst($nameParts[count($nameParts) - 1]);

        // Create directory structure for the controller if it doesn't exist
        $namespaceDir = implode('\\', array_slice($nameParts, 0, -1));
        if ($namespaceDir) {
            $namespaceDir = "\\$namespaceDir";
        }

        $controllerDir = "app/http/controllers/$namespaceDir";
        if (!is_dir($controllerDir)) {
            mkdir($controllerDir, 0777, true);
        }

        // Check if controller file already exists
        $controllerFile = "$controllerDir/$controller.php";
        if (file_exists($controllerFile)) {
            $app->writeln("Controller $controller already exists.");
            return;
        }

        // Generate controller template
        $template = <<<EOT
        <?php
        
        namespace $namespace$namespaceDir;
        
        class $controller
        {
            public function index(): void
            {
                view('view', [
                    'title' => 'Title Here',
                ]);
            }
        }
        EOT;

        file_put_contents($controllerFile, $template);

        $app->writeln("Controller $controller created successfully.");
    }

}