<?php


namespace app\components\validators;

/**
 * Class CompareValidator
 * @package app\components\validators
 */
class CompareValidator extends AbstractValidator
{
    /**
     * @var mixed
     */
    private $expectedKey;

    /**
     * CompareValidator constructor.
     * @param mixed $expectedKey
     */
    public function __construct($expectedKey)
    {
        $this->expectedKey = $expectedKey;
    }

    /**
     * @param string $key
     * @param array $data
     * @return bool
     */
    public function isValid(string $key, array $data): bool
    {
        if (!$data[$key] !== $data[$this->expectedKey]) {
            $this->errors[] = "Value should be equals to value in {$this->expectedKey}";
        }

        return empty($this->errors);
    }
}