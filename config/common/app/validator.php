<?php

namespace Lumenity\Framework\config\common\app;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Validator Class
 *
 * This class provides Laravel-like validation using Symfony Validator Component.
 */
class validator
{
    protected ValidatorInterface $validator;
    protected array $errors = [];
    protected array $messages = [];
    protected array $data = [];
    protected array $rules = [];

    /**
     * Default error messages
     */
    protected static array $defaultMessages = [
        'required' => 'Kolom :attribute wajib diisi.',
        'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
        'max' => [
            'numeric' => 'Kolom :attribute tidak boleh lebih besar dari :max.',
            'file' => 'Kolom :attribute tidak boleh lebih besar dari :max kilobytes.',
            'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'array' => 'Kolom :attribute tidak boleh memiliki lebih dari :max item.',
        ],
        'min' => [
            'numeric' => 'Kolom :attribute minimal harus :min.',
            'file' => 'Kolom :attribute minimal harus :min kilobytes.',
            'string' => 'Kolom :attribute minimal harus :min karakter.',
            'array' => 'Kolom :attribute minimal harus memiliki :min item.',
        ],
        'numeric' => 'Kolom :attribute harus berupa angka.',
        'string' => 'Kolom :attribute harus berupa string.',
        'date' => 'Kolom :attribute bukan tanggal yang valid.',
        'time' => 'Kolom :attribute bukan waktu yang valid.',
        'date_format' => 'Kolom :attribute tidak cocok dengan format :format.',
        'url' => 'Kolom :attribute harus berupa URL yang valid.',
        'alpha' => 'Kolom :attribute hanya boleh berisi huruf.',
        'alpha_num' => 'Kolom :attribute hanya boleh berisi huruf dan angka.',
        'alpha_dash' => 'Kolom :attribute hanya boleh berisi huruf, angka, dash dan underscore.',
        'boolean' => 'Kolom :attribute harus berupa true atau false.',
        'confirmed' => 'Konfirmasi :attribute tidak cocok.',
        'integer' => 'Kolom :attribute harus berupa bilangan bulat.',
        'regex' => 'Format kolom :attribute tidak valid.',
        'password' => 'Kekuatan kata sandi terlalu lemah. Harap gunakan kata sandi yang lebih kuat.',
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    /**
     * Make a new validator instance
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @return static
     */
    public static function make(array $data, array $rules, array $messages = []): self
    {
        $validator = new static();
        $validator->data = $data;
        $validator->rules = $rules;

        if (!empty($messages)) {
            $validator->setCustomMessages($messages);
        }

        $validator->validate();

        return $validator;
    }

    /**
     * Set custom error messages
     *
     * @param array $messages
     * @return void
     */
    public function setCustomMessages(array $messages): void
    {
        foreach ($messages as $rule => $message) {
            $this->messages[$rule] = $message;
        }
    }

    /**
     * Validate data against rules
     *
     * @return bool
     */
    public function validate(): bool
    {
        $this->errors = [];

        foreach ($this->rules as $field => $ruleSet) {
            $value = $this->data[$field] ?? null;
            $isNullable = $this->isNullable($ruleSet);

            // Skip validation if field is nullable and value is null
            if ($isNullable && $value === null) {
                continue;
            }

            $this->validateField($field, $value, $ruleSet);
        }

        return empty($this->errors);
    }

    /**
     * Validate a single field
     *
     * @param string $field
     * @param mixed $value
     * @param string $ruleSet
     * @return void
     */
    protected function validateField(string $field, $value, string $ruleSet): void
    {
        $rulesArray = explode('|', $ruleSet);

        foreach ($rulesArray as $rule) {
            if ($rule === 'nullable') {
                continue;
            }

            $segments = explode(':', $rule);
            $ruleName = $segments[0];
            $parameters = isset($segments[1]) ? explode(',', $segments[1]) : [];

            // Handle special rules that need custom validation
            if ($this->validateSpecialRule($field, $value, $ruleName, $parameters)) {
                continue;
            }

            // Handle standard Symfony constraints
            $constraint = $this->createConstraint($ruleName, $parameters, $field);

            if ($constraint) {
                $violations = $this->validator->validate($value, $constraint);

                if (count($violations) > 0) {
                    foreach ($violations as $violation) {
                        $this->errors[$field][] = $violation->getMessage();
                    }
                    break;
                }
            }
        }
    }

    /**
     * Validate special rules that need custom handling
     *
     * @param string $field
     * @param mixed $value
     * @param string $ruleName
     * @param array $parameters
     * @return bool
     */
    protected function validateSpecialRule(string $field, $value, string $ruleName, array $parameters): bool
    {
        switch ($ruleName) {
            case 'confirmed':
                $confirmField = $field . '_confirmation';
                $confirmValue = $this->data[$confirmField] ?? null;

                if ($value !== $confirmValue) {
                    $message = $this->getErrorMessage('confirmed', $field, $parameters);
                    $this->errors[$field][] = $message;
                }
                return true;

            case 'same':
                $otherField = $parameters[0] ?? null;
                $otherValue = $this->data[$otherField] ?? null;

                if ($value !== $otherValue) {
                    $message = $this->getErrorMessage('same', $field, $parameters);
                    $this->errors[$field][] = $message;
                }
                return true;

            case 'different':
                $otherField = $parameters[0] ?? null;
                $otherValue = $this->data[$otherField] ?? null;

                if ($value === $otherValue) {
                    $message = $this->getErrorMessage('different', $field, $parameters);
                    $this->errors[$field][] = $message;
                }
                return true;

            case 'in':
                $allowedValues = $parameters;
                if (!in_array($value, $allowedValues)) {
                    $message = $this->getErrorMessage('in', $field, $parameters);
                    $this->errors[$field][] = $message;
                }
                return true;

            case 'not_in':
                $disallowedValues = $parameters;
                if (in_array($value, $disallowedValues)) {
                    $message = $this->getErrorMessage('not_in', $field, $parameters);
                    $this->errors[$field][] = $message;
                }
                return true;

            default:
                return false;
        }
    }

    /**
     * Check if a field is nullable
     *
     * @param string $ruleSet
     * @return bool
     */
    protected function isNullable(string $ruleSet): bool
    {
        return str_contains($ruleSet, 'nullable');
    }

    /**
     * Create a Symfony constraint from a Laravel-style rule
     *
     * @param string $rule
     * @param array $parameters
     * @param string $attribute
     * @return Assert\NotBlank|Assert\Email|Assert\Length|Assert\Date|Assert\Time|Assert\Type|Assert\Url|Assert\Regex|Assert\DateTime|Assert\PasswordStrength|null
     */
    protected function createConstraint(string $rule, array $parameters, string $attribute): Assert\NotBlank|Assert\Email|Assert\Length|Assert\Date|Assert\Time|Assert\Type|Assert\Url|Assert\Regex|Assert\DateTime|Assert\PasswordStrength|null
    {
        $message = $this->getErrorMessage($rule, $attribute, $parameters);

        switch ($rule) {
            case 'required':
                return new Assert\NotBlank(['message' => $message]);

            case 'email':
                return new Assert\Email(['message' => $message]);

            case 'max':
                return new Assert\Length([
                    'maxMessage' => $message,
                    'max' => (int) $parameters[0]
                ]);

            case 'min':
                return new Assert\Length([
                    'minMessage' => $message,
                    'min' => (int) $parameters[0]
                ]);

            case 'date':
                return new Assert\Date(['message' => $message]);

            case 'time':
                return new Assert\Time(['message' => $message]);

            case 'numeric':
                return new Assert\Type([
                    'type' => 'numeric',
                    'message' => $message
                ]);

            case 'integer':
                return new Assert\Type([
                    'type' => 'integer',
                    'message' => $message
                ]);

            case 'string':
                return new Assert\Type([
                    'type' => 'string',
                    'message' => $message
                ]);

            case 'boolean':
                return new Assert\Type([
                    'type' => 'bool',
                    'message' => $message
                ]);

            case 'url':
                return new Assert\Url(['message' => $message]);

            case 'alpha':
                return new Assert\Regex([
                    'pattern' => '/^[a-zA-Z]+$/',
                    'message' => $message
                ]);

            case 'alpha_num':
                return new Assert\Regex([
                    'pattern' => '/^[a-zA-Z0-9]+$/',
                    'message' => $message
                ]);

            case 'alpha_dash':
                return new Assert\Regex([
                    'pattern' => '/^[a-zA-Z0-9_-]+$/',
                    'message' => $message
                ]);

            case 'regex':
                return new Assert\Regex([
                    'pattern' => '/' . $parameters[0] . '/',
                    'message' => $message
                ]);

            case 'date_format':
                return new Assert\DateTime([
                    'format' => $parameters[0],
                    'message' => $message
                ]);

            case 'password':
                // Check if PasswordStrength constraint exists
                if (class_exists('Symfony\Component\Validator\Constraints\PasswordStrength')) {
                    $options = ['message' => $message];

                    // Parse password strength options
                    if (!empty($parameters)) {
                        foreach ($parameters as $param) {
                            switch ($param) {
                                case 'min':
                                    $options['minLength'] = 8;
                                    break;
                                case 'letters':
                                    $options['requireLetters'] = true;
                                    break;
                                case 'mixed':
                                    $options['requireCaseDiff'] = true;
                                    break;
                                case 'numbers':
                                    $options['requireNumbers'] = true;
                                    break;
                                case 'symbols':
                                    $options['requireSpecialCharacter'] = true;
                                    break;
                            }
                        }
                    }

                    return new Assert\PasswordStrength($options);
                } else {
                    // Fallback to regex for basic password validation
                    return new Assert\Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/',
                        'message' => $message
                    ]);
                }

            default:
                return null;
        }
    }

    /**
     * Get error message for a rule
     *
     * @param string $rule
     * @param string $attribute
     * @param array $parameters
     * @return string
     */
    protected function getErrorMessage(string $rule, string $attribute, array $parameters): string
    {
        // Check for custom message
        if (isset($this->messages[$attribute . '.' . $rule])) {
            $message = $this->messages[$attribute . '.' . $rule];
        } elseif (isset($this->messages[$rule])) {
            $message = $this->messages[$rule];
        } else {
            // Get default message
            $message = $this->getDefaultMessage($rule, $parameters);
        }

        // Replace placeholders
        $message = str_replace(':attribute', $attribute, $message);

        // Replace rule-specific placeholders
        switch ($rule) {
            case 'max':
            case 'min':
                $message = str_replace(':' . $rule, $parameters[0] ?? '', $message);
                break;
            case 'date_format':
                $message = str_replace(':format', $parameters[0] ?? '', $message);
                break;
            case 'same':
            case 'different':
                $message = str_replace(':other', $parameters[0] ?? '', $message);
                break;
            case 'in':
                $message = str_replace(':values', implode(', ', $parameters), $message);
                break;
        }

        return $message;
    }

    /**
     * Get default message for a rule
     *
     * @param string $rule
     * @param array $parameters
     * @return string
     */
    protected function getDefaultMessage(string $rule, array $parameters): string
    {
        // Add more default messages
        $additionalMessages = [
            'same' => 'Kolom :attribute dan :other harus sama.',
            'different' => 'Kolom :attribute dan :other harus berbeda.',
            'in' => 'Kolom :attribute yang dipilih tidak valid.',
            'not_in' => 'Kolom :attribute yang dipilih tidak valid.',
        ];

        $allMessages = array_merge(self::$defaultMessages, $additionalMessages);

        if (isset($allMessages[$rule])) {
            $message = $allMessages[$rule];

            // Handle nested messages (like max.string)
            if (is_array($message)) {
                $type = 'string'; // Default type
                return $message[$type] ?? reset($message);
            }

            return $message;
        }

        return "Validasi untuk kolom :attribute gagal.";
    }

    /**
     * Check if validation fails
     *
     * @return bool
     */
    public function fails(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Check if validation passes
     *
     * @return bool
     */
    public function passes(): bool
    {
        return empty($this->errors);
    }

    /**
     * Get validation errors
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Get first error message for a field
     *
     * @param string|null $field
     * @return string|null
     */
    public function first(string $field = null): ?string
    {
        if ($field === null) {
            foreach ($this->errors as $fieldErrors) {
                if (!empty($fieldErrors)) {
                    return $fieldErrors[0];
                }
            }
            return null;
        }

        return $this->errors[$field][0] ?? null;
    }

    /**
     * Get all error messages
     *
     * @return array
     */
    public function all(): array
    {
        $all = [];
        foreach ($this->errors as $fieldErrors) {
            foreach ($fieldErrors as $error) {
                $all[] = $error;
            }
        }
        return $all;
    }
}