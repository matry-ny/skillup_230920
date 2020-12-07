<?php

namespace app\components;

use app\components\validators\AbstractValidator;
use app\components\validators\CompareValidator;

/**
 * Class Validator
 * @package app\components
 */
class Validator extends AbstractComponent
{
    private array $data;
    private array $rules;
    private array $result = [];
    private array $errors = [];

    /**
     * Validator constructor.
     * @param array $data
     * @param array<string, array<int, AbstractValidator>> $rules
     */
    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    /**
     * @return Validator
     */
    public function run(): self
    {
        foreach ($this->data as $key => $value) {
            if (!array_key_exists($key, $this->rules)) {
                $this->addValidData($key, $value);
                continue;
            }

            $this->check($key, $value, $this->rules[$key]);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getValidData(): array
    {
        return $this->result;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param string $key
     * @param $value
     * @param AbstractValidator[] $validators
     */
    private function check(string $key, $value, array $validators): void
    {
        $isValid = true;
        foreach ($validators as $validator) {
            if (!$this->processValidation($validator, $key)) {
                $isValid = false;
            }
        }

        if ($isValid) {
            $this->addValidData($key, $value);
        }
    }

    /**
     * @param AbstractValidator $validator
     * @param string $key
     * @return bool
     */
    private function processValidation(AbstractValidator $validator, string $key): bool
    {
        if (!$validator->isValid($key, $this->data)) {
            $this->addErrors($key, $validator->getErrors());
            return false;
        }

        return true;
    }

    /**
     * @param string $key
     * @param array $errors
     */
    private function addErrors(string $key, array $errors): void
    {
        if (array_key_exists($key, $this->errors)) {
            $this->errors[$key] = array_merge($this->errors[$key], $errors);
        } else {
            $this->errors[$key] = $errors;
        }
    }

    /**
     * @param string $key
     * @param mixed $data
     */
    private function addValidData(string $key, $data): void
    {
        $this->result[$key] = $data;
    }
}
