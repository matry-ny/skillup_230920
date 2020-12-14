<?php

namespace app\components\db\where;

/**
 * Class Compare
 * @package app\components\db\where
 */
class Compare extends AbstractConditionBuilder
{
    /**
     * @var float|int|string
     */
    private $value;

    /**
     * Compare constructor.
     * @param string $field
     * @param string $operator
     * @param string|int|float $value
     */
    public function __construct(string $field, string $operator, $value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function build(): string
    {
        $hash = $this->getUniqueHash();
        $alias = "{$this->field}_{$hash}";

        $this->binds[$alias] = $this->value;

        return "`{$this->field}` {$this->operator} :{$alias}";
    }
}
