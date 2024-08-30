<?php

namespace Lumenity\Framework\config\common\commands\seeds;

use Lumenity\Framework\config\common\interface\command;
use Rakit\Console\App;

/**
 * Class createseed
 *
 * This class implements the command interface and is used to create a new database seed.
 *
 * @package Lumenity\Framework\config\common\commands\seeds
 */
class createseed implements command
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
        // Get the name of the seed
        $name = $args["name"] ?? null;
        if (!$name) {
            $app->writeln("Name is required.");
            return;
        }

        if (ucfirst($name) !== $name) {
            $app->writeln("Name must start with a capital letter.");
            return;
        }

        $files = glob(__DIR__ . "/../../../../database/seeds/$name.php");
        if(!empty($files)) {
            $app->writeln("Seed already exists.");
            return;
        }

        passthru("php " . __DIR__ . "/../../../../vendor/bin/phinx seed:create $name --configuration=config/common/utils/phinx.php");

        $files = glob(__DIR__ . "/../../../../database/seeds/$name.php");

        $template = <<<EOT
        <?php

        declare(strict_types=1);

        use Faker\Generator;
        use Lumenity\Framework\config\common\utils\seeder as Factory;

        /**
         * Class $name
         *
         * This class extends the Factory class and is used to seed the database.
         * The run method generates fake data and inserts it into the database.
         */
        class $name extends Factory
        {
            /**
             * The run method.
             *
             * This method generates fake data and inserts it into the database.
             * The data is generated using the Faker library and the factory method from the parent class.
             *
             * @return void
             */
            public function run(): void
            {
                \$data = self::factory(10, function (Generator \$faker) {
                    return [
                        'name' => \$faker->name,
                        'email' => \$faker->unique()->safeEmail,
                        'created_at' => \$faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                        'updated_at' => \$faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                    ];
                });

                \$this->insert('table', \$data);
            }
        }
        EOT;

        file_put_contents($files[0], $template);

        $app->writeln("Seed created successfully.");
    }
}