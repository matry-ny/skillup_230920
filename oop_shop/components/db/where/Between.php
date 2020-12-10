<?php

namespace app\components\db\where;

/**
 * Class Between
 * @package app\components\db\where
 */
class Between extends AbstractConditionBuilder
{
    private string $field;
    private string $operator;

    /**
     * @var float|int|string
     */
    private $from;

    /**
     * @var float|int|string
     */
    private $to;

    /**
     * Between constructor.
     * @param string $field
     * @param string $operator
     * @param string|int|float $from
     * @param string|int|float $to
     */
    public function __construct(string $field, string $operator, $from, $to)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function build(): string
    {
        $hash = uniqid($this->field, true);
        $fromAlias = "{$this->field}_{$hash}_from";
        $toAlias = "{$this->field}_{$hash}_to";

        $this->binds[$fromAlias] = $this->from;
        $this->binds[$toAlias] = $this->to;

        return "`{$this->field}` {$this->operator} :{$fromAlias} AND :{$toAlias}";
    }
}