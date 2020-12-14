<?php

namespace app\components\db\where;

/**
 * Class Nullable
 * @package app\components\db\where
 */
class Nullable extends AbstractConditionBuilder
{
    /**
     * Compare constructor.
     * @param string $field
     * @param string $operator
     */
    public function __construct(string $field, string $operator)
    {
        $this->field = $field;
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function build(): string
    {
        return "`{$this->field}` {$this->operator}";
    }
}
