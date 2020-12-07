<?php

namespace app\components\validators;

/**
 * Class AbstractValidator
 * @package app\components\validators
 */
abstract class AbstractValidator
{
    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @param string $key
     * @param array $data
     * @return bool
     */
    abstract public function isValid(string $key, array $data): bool;

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
