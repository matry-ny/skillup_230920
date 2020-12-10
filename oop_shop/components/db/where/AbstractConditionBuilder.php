<?php

namespace app\components\db\where;

/**
 * Class AbstractConditionBuilder
 * @package app\components\db\where
 */
abstract class AbstractConditionBuilder
{
    /**
     * @var array
     */
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
}
