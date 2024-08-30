<?php

namespace Lumenity\Framework\config\common\commands\app;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Model Command Class
 *
 * This class implements the command interface and provides a method to create a new model in the Lumenity Framework.
 * It creates a new model file with the specified name and namespace, along with basic model structure.
 */
class model implements command
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
        // Check if the name is provided
        $name = $args['name'] ?? null;
        if (!$name) {
            $app->writeln("Name is required.");
            return;
        }

        // Parse the name and generate the model file
        $nameParts = explode('/', $name);
        $namespace = 'Lumenity\\Framework\\app\\models';
        $modelName = ucfirst($nameParts[count($nameParts) - 1]);

        // Create directory structure for the model if it doesn't exist
        $namespaceDir = implode('\\', array_slice($nameParts, 0, -1));
        if ($namespaceDir) {
            $namespaceDir = "\\$namespaceDir";
        }

        $modelDir = "app/models/$namespaceDir";
        if (!is_dir($modelDir)) {
            mkdir($modelDir, 0777, true);
        }

        // Check if model file already exists
        $modelFile = "$modelDir/$modelName.php";
        if (file_exists($modelFile)) {
            $app->writeln("Model $modelName already exists.");
            return;
        }

        function convertToSnakeCase($modelName): string
        {
            return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $modelName));
        }

        $tableName = convertToSnakeCase($modelName);

        // Generate model template
        $template = <<<EOT
        <?php
        
        namespace $namespace$namespaceDir;
        
        use Illuminate\Database\Eloquent\Model;
        use Ramsey\Uuid\Uuid;
        
        class $modelName extends Model
        {
            public function __construct(array \$attributes = [])
            {
                parent::__construct(\$attributes);
                \$this->attributes['id'] = Uuid::uuid4()->toString();
            }
            
            protected \$table = '$tableName';
            
            protected \$fillable = ['id'];
        
            protected \$casts = [
                'id' => 'string',
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
            ];
        }
        EOT;

        // Write the model template to the file
        file_put_contents($modelFile, $template);

        // Display success message
        $app->writeln("Model $modelName created successfully.");

        // Run the migration command
        if (array_intersect(['--migrate', '-m'], $option)) {
            passthru("php artisan make:migration $modelName");
        }

        // Run the factory command
        if (array_intersect(['--factory', '-f'], $option)) {
            passthru("php artisan make:factory $modelName" . "Factory");
        }
    }

}