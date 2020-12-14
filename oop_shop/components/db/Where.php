<?php


namespace app\components\db;


use app\components\db\where\AbstractConditionBuilder;
use app\components\db\where\Between;
use app\components\db\where\Compare;
use app\components\db\where\In;
use app\components\db\where\Nullable;
use app\exceptions\DBException;

/**
 * Class Where
 * @package app\components\db
 */
class Where
{
    private array $conditions;
    private string $glue;

    private string $sql = '';
    private array $binds = [];

    /**
     * Where constructor.
     * @param array $conditions
     * @param string $glue
     */
    public function __construct(array $conditions, string $glue)
    {
        $this->conditions = $conditions;
        $this->glue = $glue;

        $this->build();
    }

    /**
     * @return string
     */
    public function getSQL(): string
    {
        return $this->sql;
    }

    /**
     * @return array
     */
    public function getBinds(): array
    {
        return $this->binds;
    }

    private function build(): void
    {
        $conditions = [];
        foreach ($this->conditions as $condition) {
            $builder = $this->getBuilder($condition);
            $conditions[] = $builder->build();
            $this->binds = array_merge($this->binds, $builder->getBinds());
        }

        $this->sql = implode(" {$this->glue} ", $conditions);
    }

    /**
     * @param array $condition
     * @return AbstractConditionBuilder
     * @throws DBException
     */
    private function getBuilder(array $condition): AbstractConditionBuilder
    {
        if (!isset($condition[1])) {
            $error = json_encode($condition);
            throw new DBException("Operator is invalid in {$error}");
        }

        $operator = strtolower(trim($condition[1]));
        switch ($operator) {
            case '>':
            case '>=':
            case '<':
            case '<=':
            case '=':
            case '!=':
            case '<>':
            case 'like':
            case 'not like':
                return new Compare(...$condition);
            case 'between':
            case 'not between':
                return new Between(...$condition);
            case 'in':
            case 'not in':
                return new In(...$condition);
            case 'is null':
            case 'is not null':
                return new Nullable(...$condition);
            default:
                throw new DBException("Operator '{$operator}' is invalid");
        }
    }
}