<?php


namespace app\components\validators;

/**
 * Class RegExpValidator
 * @package app\components\validators
 */
class RegExpValidator extends AbstractValidator
{
    private string $regExp;

    /**
     * StringValidator constructor.
     * @param string $regExp
     */
    public function __construct(string $regExp)
    {
        $this->regExp = $regExp;
    }

    /**
     * @param string $key
     * @param array $data
     * @return bool
     */
    public function isValid(string $key, array $data): bool
    {
        if (!preg_match($this->regExp, $data[$key])) {
            $this->errors[] = "Value should be like {$this->regExp}";
        }

        return empty($this->errors);
    }
}