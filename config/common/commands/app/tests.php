<?php

namespace Lumenity\Framework\config\common\commands\app;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 *  Tests Command Class
 *
 * This class implements the command interface and provides a method to create a new test in the Lumenity Framework.
 * It creates a new test file with the specified name and namespace, along with a basic test structure.
 */
class tests implements command
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
        // Get the name of the test from the command arguments
        $name = $args['name'] ?? null;
        if (!$name) {
            $app->writeln("Name is required.");
            return;
        }

        $nameParts = explode('/', $name);
        $namespace = 'Lumenity\\Framework\\tests\\feature';
        $test = $nameParts[count($nameParts) - 1];

        $namespaceDir = implode('\\', array_slice($nameParts, 0, -1));
        if ($namespaceDir) {
            $namespaceDir = "\\$namespaceDir";
        }

        $testDir = "tests/feature/$namespaceDir";
        if (!is_dir($testDir)) {
            mkdir($testDir, 0777, true);
        }

        $testFile = "$testDir/$test.php";
        if (file_exists($testFile)) {
            $app->writeln("Test $test already exists.");
            return;
        }

        $template = <<<EOT
        <?php
        
        namespace $namespace$namespaceDir;
        
        use PHPUnit\Framework\TestCase;
        
        class $test extends TestCase
        {
            
        }
        
        EOT;

        file_put_contents($testFile, $template);

        $app->writeln("Test $test created successfully.");
    }
}