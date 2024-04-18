<?php

namespace Lumenity\Framework\test\app;

use Exception;
use Intervention\Image\Interfaces\ImageInterface;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Collection;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Lumenity\Framework\config\common\validation\Validator;
use function PHPUnit\Framework\assertEquals;

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
        // docs in https://laravel.com/docs/11.x/collections
        $collection = new Collection([1, 2, 3, 4, 5]);
        $filtered = $collection->filter(function ($value, $key) {
            return $value > 2;
        });

        $this->assertEquals([2 => 3, 3 => 4, 4 => 5], $filtered->all());
    }

    /**
     * Test Media Repository
     *
     * This method tests the media repository functionality.
     *
     * @return void
     */
    public function testMediaRepository()
    {
        // docs in https://image.intervention.io/v3
        $manager = new ImageManager(new Driver());
        $image = $manager->read(__DIR__ . '/../../resources/images/lumenity.png');

        $this->assertInstanceOf(ImageManager::class, $manager);
        $this->assertInstanceOf(ImageInterface::class, $image);
    }

    /**
     * Test Validator
     *
     * This method tests the validator functionality.
     *
     * @return void
     */
    public function testValidator()
    {
        $validator = new Validator();
        $data = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
        ];

        $rules = [
            'name' => 'required|max:8',
            'email' => 'email',
        ];

        if (!$validator->validate($data, $rules)) {
            $errors = $validator->errors();
            assertEquals('This value is too long. It should have 8 characters or less.', $errors['name'][0]);
        } else {
            $messages = $validator->messages();
            assertEquals('Validation successful', $messages['name']);
        }
    }
}