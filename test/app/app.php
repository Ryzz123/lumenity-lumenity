<?php

namespace Lumenity\Framework\test\app;

use Exception;
use Illuminate\Support\Collection;
use Lumenity\Framework\config\common\app\validator;
use PHPUnit\Framework\TestCase;
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
     * Test Validator
     *
     * This method tests the validator functionality.
     *
     * @return void
     */
    public function testValidator()
    {
        $validator = new validator();
        $data = [
            'name' => 'John Does',
            'email' => 'john@gmail.com',
        ];

        $rules = [
            'name' => 'required|max:8',
            'email' => 'email',
        ];

        if (!$validator->validate($data, $rules)) {
            $errors = $validator->errors();
            assertEquals('Nilai ini terlalu panjang. Harus memiliki 8 karakter atau kurang.', $errors['name'][0]->message);
        } else {
            $messages = $validator->messages();
            assertEquals('Validation successful', $messages['name']);
        }
    }
}