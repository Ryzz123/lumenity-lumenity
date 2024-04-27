<?php

namespace Lumenity\Framework\config\common\commands\app;

use Rakit\Console\App;


/**
 * Service Command
 *
 * This command creates a new service.
 *
 */
class service implements command
{

    /**
     * Create
     *
     * This method creates a new service.
     *
     * @param App $app
     * @param string|null $name
     * @return void
     */
    public function create(App $app, ?string $name): void
    {
        if (!$name) {
            $app->writeln("Name is required.");
            return;
        }

        $nameParts = explode('/', $name);
        $namespace = 'Lumenity\\Framework\\app\\services';
        $serviceName = ucfirst($nameParts[count($nameParts) - 1]);

        $namespaceDir = implode('\\', array_slice($nameParts, 0, -1));
        if ($namespaceDir) {
            $namespaceDir = "\\$namespaceDir";
        }

        $serviceDir = "app/services/$namespaceDir";
        if (!is_dir($serviceDir)) {
            mkdir($serviceDir, 0777, true);
        }

        $serviceFile = "$serviceDir/$serviceName.php";
        if (file_exists($serviceFile)) {
            $app->writeln("Service $serviceName already exists.");
            return;
        }

        $template = <<<EOT
        <?php

        namespace $namespace$namespaceDir;
        
        use Lumenity\Framework\config\common\utils\service as Service;
        
        class $serviceName extends Service
        {
            // Add your service methods here
        }
        EOT;

        file_put_contents($serviceFile, $template);

        $app->writeln("Service $serviceName created successfully.");
    }
}