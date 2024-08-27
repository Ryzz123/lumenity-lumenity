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
     * Create Controller
     *
     * Creates a new controller with the given name and namespace.
     *
     * @param App $app The console application instance
     * @param string|null $name The name of the controller to be created
     * @param string|null $config The configuration for the controller
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
        
        use Exception;
        use Illuminate\Http\Request;
        use JetBrains\PhpStorm\NoReturn;
        use Lumenity\Framework\config\common\http\Response;
        
        class $controller
        {
            public function index(Request \$req, Response \$res): void
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