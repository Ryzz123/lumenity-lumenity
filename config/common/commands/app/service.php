<?php

namespace Lumenity\Framework\config\common\commands\app;

use Lumenity\Framework\config\common\interface\command;
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
     * This method creates a new middleware in the application.
     *
     * @param App $app
     * @param array $args
     * @param array $option
     * @return void
     */
    public function create(App $app, array $args, array $option): void
    {
        $name = $args['name'] ?? null;
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

        if (array_intersect(['-i', '--interface'], $option)) {
            $interfaceName = "I" . $serviceName;
            $template = <<<EOT
        <?php

        namespace $namespace$namespaceDir;
        
        use Lumenity\Framework\config\common\utils\service as Service;
        use Lumenity\Framework\app\interface$namespaceDir\\$interfaceName;
        
        class $serviceName extends Service implements $interfaceName
        {
            // Add your service methods here
        }
        EOT;
        } else {
            $template = <<<EOT
        <?php

        namespace $namespace$namespaceDir;
        
        use Lumenity\Framework\config\common\utils\service as Service;
        
        class $serviceName extends Service
        {
            // Add your service methods here
        }
        EOT;
        }

        file_put_contents($serviceFile, $template);

        $app->writeln("Service $serviceName created successfully.");
    }
}