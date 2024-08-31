<?php

namespace Lumenity\Framework\config\common\commands\app;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

class interfaces implements command
{

    /**
     * @inheritDoc
     */
    public function create(App $app, array $args, array $option): void
    {
        $name = $args['name'] ?? null;
        if (!$name) {
            $app->writeln("Name is required.");
            return;
        }

        $nameParts = explode('/', $name);
        $namespace = 'Lumenity\\Framework\\app\\interface';
        $interfaceName = "I" . ucfirst($nameParts[count($nameParts) - 1]);

        $namespaceDir = implode('\\', array_slice($nameParts, 0, -1));
        if ($namespaceDir) {
            $namespaceDir = "\\$namespaceDir";
        }

        $interfaceDir = "app/interface/$namespaceDir";
        if (!is_dir($interfaceDir)) {
            mkdir($interfaceDir, 0777, true);
        }

        $interfaceFile = "$interfaceDir/$interfaceName.php";
        if (file_exists($interfaceFile)) {
            $app->writeln("Interface $interfaceName already exists.");
            return;
        }

        $template = <<<EOT
        <?php
        
        namespace $namespace$namespaceDir;
        
        interface $interfaceName
        {
            public function findAll(array \$param): array;
            public function findById(string \$id): object;
            public function save(object \$data): object;
            public function update(string \$id, object \$data): object;
            public function delete(string \$id): bool;
        }
        EOT;

        file_put_contents($interfaceFile, $template);

        $app->writeln("Interface $interfaceName created successfully.");

        // Run the service command
        if (array_intersect(['--service', '-s'], $option)) {
            $serviceName = explode("I", $interfaceName)[1];
            $dirNames = $namespaceDir !== "" ? explode('/', ltrim($namespaceDir, '\\')) : [];
            $serviceName = implode('/', $dirNames) . '/' . $serviceName;
            passthru("php artisan make:service $serviceName --interface");
        }
    }
}