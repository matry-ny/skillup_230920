<?php

namespace app\components\db\where;

/**
 * Class In
 * @package app\components\db\where
 */
class In extends AbstractConditionBuilder
{
    private array $values;

    /**
     * Compare constructor.
     * @param string $field
     * @param string $operator
     * @param array $values
     */
    public function __construct(string $field, string $operator, array $values)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->values = $values;
    }

    /**
     * @return string
     */
    public function build(): string
    {
        $hash = $this->getUniqueHash();
        $alias = "{$this->field}_{$hash}";

        $inSQL = [];
        foreach ($this->values as $index => $value) {
            $key = "{$alias}_{$index}";
            $inSQL[] = $key;
            $this->binds[$key] = $value;
        }

        $in = implode(', :', $inSQL);
        return "`{$this->field}` {$this->operator} (:{$in})";
    }
}
