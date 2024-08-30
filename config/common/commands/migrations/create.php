<?php

namespace Lumenity\Framework\config\common\commands\migrations;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Class create
 * This class implements the command interface and provides a method to create a new migration.
 */
class create implements command
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

        // Check if the name starts with a capital letter
        if (ucfirst($name) !== $name) {
            $app->writeln("Name must start with a capital letter.");
            return;
        }

        // Convert the name to snake case
        function convertToSnakeCase($name): string
        {
            return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name));
        }

        // Check if a migration with the same name already exists
        $files = glob(__DIR__ . "/../../../../database/migrations/*_" . convertToSnakeCase($name) . ".php");
        if (!empty($files)) {
            $app->writeln("Migration already exists.");
            return;
        }

        // Create a new migration file
        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx create $name --configuration=config/common/utils/phinx.php");

        // Get the newly created migration file
        $files = glob(__DIR__ . "/../../../../database/migrations/*_" . convertToSnakeCase($name) . ".php");

        // Get the table name from the migration name
        $table = convertToSnakeCase($name);

        // Define a basic template for the migration
        $template = <<<EOT
        <?php

        declare(strict_types=1);

        use Illuminate\Database\Schema\Blueprint;
        use Phinx\Migration\AbstractMigration;
        use Lumenity\Framework\database\connection as Schema;

        final class $name extends AbstractMigration
        {
            public function up(): void
            {
                Schema::schema()->create('$table', function (Blueprint \$table) {
                    \$table->id();
                    \$table->timestamps();
                });
            }

            public function down(): void
            {
                Schema::schema()->dropIfExists('$table');
            }
        }
        EOT;

        // Write the template to the migration file
        file_put_contents($files[0], $template);

        // Notify the user that the migration was created successfully
        $app->writeln("Migration created successfully.");
    }
}