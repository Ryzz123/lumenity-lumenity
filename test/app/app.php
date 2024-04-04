<?php

namespace Lumenity\Framework\test\app;

use Exception;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Collection;

/**
 * App Test Case
 *
 * This class contains test cases related to the application functionality.
 */
class app extends TestCase
{
    /**
     * Test Welcome Message
     *
     * This method tests the welcome message of the application.
     *
     * @return void
     * @throws Exception
     */
    public function testWelcome(): void
    {
        // Perform the welcome message test
        $this->assertEquals('Welcome to Lumenity Framework', 'Welcome to Lumenity Framework');
    }

    /**
     * Test Collection
     *
     * This method tests the collection functionality.
     *
     * @return void
     */
    public function testCollection()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $filtered = $collection->filter(function ($value, $key) {
            return $value > 2;
        });

        $this->assertEquals([2 => 3, 3 => 4, 4 => 5], $filtered->all());
    }
}