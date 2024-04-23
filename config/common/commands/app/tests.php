<?php

namespace Lumenity\Framework\config\common\commands\app;

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
     * Create Test
     *
     * Creates a new test with the given name and namespace.
     *
     * @param App $app The console application instance
     * @param string|null $name The name of the test to be created
     * @return void
     */
    public function create(App $app, ?string $name): void
    {
        if (!$name) {
            $app->writeln("Name is required.");
            return;
        }

        $nameParts = explode('/', $name);
        $namespace = 'Lumenity\\Framework\\test\\app';
        $test = $nameParts[count($nameParts) - 1];

        $namespaceDir = implode('\\', array_slice($nameParts, 0, -1));
        if ($namespaceDir) {
            $namespaceDir = "\\$namespaceDir";
        }

        $testDir = "test/app/$namespaceDir";
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
            public function testWelcome(): void
            {
                // Perform the welcome message test
                \$this->assertEquals('Welcome to Lumenity Framework', 'Welcome to Lumenity Framework');
            }
        }
        
        EOT;

        file_put_contents($testFile, $template);

        $app->writeln("Test $test created successfully.");
    }
}