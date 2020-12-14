<?php

namespace app\components\db\where;

/**
 * Class AbstractConditionBuilder
 * @package app\components\db\where
 */
abstract class AbstractConditionBuilder
{
    protected string $field;
    protected string $operator;
    protected array $binds = [];

    /**
     * @return string
     */
    abstract public function build(): string;

    /**
     * @return array
     */
    public function getBinds(): array
    {
        return $this->binds;
    }

    /**
     * @return string
     */
    protected function getUniqueHash(): string
    {
        return spl_object_id($this) . '_' . mt_rand();
    }
}
