<?php


namespace app\components\validators;

/**
 * Class StringValidator
 * @package app\components\validators
 */
class StringValidator extends AbstractValidator
{
    private int $minLength;
    private int $maxLength;

    /**
     * StringValidator constructor.
     * @param int $minLength
     * @param int $maxLength
     */
    public function __construct(int $minLength, int $maxLength)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    /**
     * @param string $key
     * @param array $data
     * @return bool
     */
    public function isValid(string $key, array $data): bool
    {
        $length = strlen($data[$key]);
        if ($length < $this->minLength) {
            $this->errors[] = "String should be min {$this->minLength} symbols";
        }
        if ($length > $this->maxLength) {
            $this->errors[] = "String should be max {$this->maxLength} symbols";
        }

        return empty($this->errors);
    }
}