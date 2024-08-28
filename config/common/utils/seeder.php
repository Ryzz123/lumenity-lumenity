<?php

namespace Lumenity\Framework\config\common\utils;

use Faker\Generator;
use Phinx\Seed\AbstractSeed;
use Faker\Factory as Faker;

/**
 * Class factory
 *
 * This class extends the AbstractSeed class from the Phinx library.
 * It is used to generate fake data for seeding databases.
 *
 * @package Lumenity\Framework\config\common\utils
 */
class seeder extends AbstractSeed
{
    /**
     * @var Generator $faker
     * An instance of the Faker\Generator class.
     */
    public static Generator $faker;

    /**
     * factory constructor.
     *
     * The constructor method initializes the parent class and creates a new instance of the Faker\Generator class.
     */
    public function __construct()
    {
        parent::__construct();
        self::$faker = Faker::create();
    }

    /**
     * The factory method.
     *
     * This method generates an array of fake data based on the provided callback function.
     * The callback function is expected to take an instance of Faker\Generator as an argument and return an array of data.
     *
     * @param int $count The number of data rows to generate.
     * @param callable $callback The callback function to generate the data.
     * @return array The generated data.
     */
    public static function factory(int $count, callable $callback): array
    {
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $data[] = $callback(self::$faker);
        }
        return $data;
    }
}