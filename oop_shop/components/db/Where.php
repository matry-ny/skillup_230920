<?php


namespace app\components\db;


use app\components\db\where\AbstractConditionBuilder;
use app\components\db\where\Between;
use app\components\db\where\Compare;
use app\components\db\where\In;
use app\components\db\where\Nullable;
use app\exceptions\DBException;

class Where
{
    /**
     * @var array
     */
    private array $conditions;

    /**
     * Where constructor.
     * @param array $conditions
     */
    public function __construct(array $conditions)
    {
        $this->conditions = $conditions;
    }

    public function getSQL(): string
    {
        $conditions = [];
        $bindings = [];
        foreach ($this->conditions as $condition) {
            $builder = $this->getBuilder($condition);
            $conditions[] = $builder->build();
            $bindings = array_merge($bindings, $builder->getBinds());
        }

        var_dump($conditions, $bindings);exit;
    }

    private function getBuilder(array $condition): AbstractConditionBuilder
    {
        if (!isset($condition[1])) {
            $error = json_encode($condition);
            throw new DBException("Operator is invalid in {$error}");
        }

        $operator = $condition[1];
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