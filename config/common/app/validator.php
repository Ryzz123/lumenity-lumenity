<?php

namespace Lumenity\Framework\config\common\app;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PasswordStrength;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Validator Class
 *
 * This class provides methods for data validation using Symfony Validator Component.
 * It validates data against specified rules and returns errors and messages.
 */
class validator
{
    protected ValidatorInterface $validator;
    protected array $errors;
    protected array $messages;
    protected static array $rootMessages = [
        'required' => 'Nilai ini wajib diisi.',
        'max' => 'Nilai ini terlalu panjang. Harus memiliki karakter {{ limit }} atau kurang.|Nilai ini terlalu panjang. Harus memiliki {{ limit }} karakter atau kurang.',
        'min' => 'Nilai ini terlalu pendek. Harus memiliki karakter {{ limit }} atau lebih.|Nilai ini terlalu pendek. Itu harus memiliki {{ limit }} karakter atau lebih.',
        'email' => 'Nilai ini bukan alamat email yang valid.',
        'password' => 'Kekuatan kata sandi terlalu lemah. Harap gunakan kata sandi yang lebih kuat.',
        'jpeg' => 'File ini bukan gambar JPEG yang valid.',
        'png' => 'File ini bukan gambar PNG yang valid.',
        'gif' => 'File ini bukan gambar GIF yang valid.',
        'jpg' => 'File ini bukan gambar JPG yang valid.',
        'maxsize' => 'Filenya terlalu besar. Ukuran maksimum yang diperbolehkan adalah {{ limit }} byte.',
    ];

    /**
     * Constructor
     *
     * Initializes the Validator instance.
     */
    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    /**
     * Validate Data
     *
     * Validates the provided data against specified rules.
     *
     * @param array $data The data to be validated
     * @param array $rules The validation rules
     * @return bool True if validation passes, false otherwise
     */
    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->messages = [];

        foreach ($rules as $field => $constraints) {
            $constraints = $this->parseRules($constraints);
            foreach ($constraints as $constraint) {
                $value = $data[$field] ?? null;
                $violation = $this->validator->validate($value, $constraint);

                if ($violation->count() > 0) {
                    $this->errors[$field][] = (object)[
                        'message' => $violation[0]->getMessage(),
                        'invalidValue' => $violation[0]->getInvalidValue(),
                    ];
                    break;
                } else {
                    $this->messages[$field] = 'Validation successful';
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * Parse Validation Rules
     *
     * Parses the validation rules string and converts them into Symfony Constraint instances.
     *
     * @param string $rules The validation rules string
     * @return array An array of Symfony Constraint instances
     */
    protected function parseRules(string $rules): array
    {
        $parsedRules = [];

        $rulesArray = explode('|', $rules);
        foreach ($rulesArray as $rule) {
            $segments = explode(':', $rule);
            $constraintName = $segments[0];
            $options = isset($segments[1]) ? explode(',', $segments[1]) : [];

            switch ($constraintName) {
                case 'required':
                    $parsedRules[] = new NotBlank(['message' => self::$rootMessages['required']]);
                    break;
                case 'max':
                    $parsedRules[] = new Length(['maxMessage' => self::$rootMessages['max'], 'max' => $options[0]]);
                    break;
                case 'min':
                    $parsedRules[] = new Length(['minMessage' => self::$rootMessages['min'], 'min' => $options[0]]);
                    break;
                case 'email':
                    $parsedRules[] = new Email(['message' => self::$rootMessages['email']]);
                    break;
                case 'password':
                    $parsedRules[] = new PasswordStrength(['message' => self::$rootMessages['password']]);
                    break;
                case 'image':
                    $parsedRules[] = new Image();
                    break;
                case 'jpeg':
                    $parsedRules[] = new Image(['message' => self::$rootMessages['jpeg'], 'mimeTypes' => ['image/jpeg']]);
                    break;
                case 'png':
                    $parsedRules[] = new Image(['message' => self::$rootMessages['png'], 'mimeTypes' => ['image/png']]);
                    break;
                case 'gif':
                    $parsedRules[] = new Image(['message' => self::$rootMessages['gif'], 'mimeTypes' => ['image/gif']]);
                    break;
                case 'jpg':
                    $parsedRules[] = new Image(['message' => self::$rootMessages['jpg'], 'mimeTypes' => ['image/jpg']]);
                    break;
                case 'maxsize':
                    $parsedRules[] = new Image(['message' => self::$rootMessages['maxsize'], 'maxSize' => $options[0]]);
                    break;
                default:
                    break;
            }
        }

        return $parsedRules;
    }

    /**
     * Get Validation Errors
     *
     * Returns the validation errors.
     *
     * @return array The validation errors
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Get Validation Messages
     *
     * Returns the validation messages.
     *
     * @return array The validation messages
     */
    public function messages(): array
    {
        return $this->messages;
    }
}