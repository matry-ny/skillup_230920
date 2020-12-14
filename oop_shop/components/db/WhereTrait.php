<?php

namespace app\components\db;

/**
 * Trait WhereTrait
 * @package app\components\db
 */
trait WhereTrait
{
    /**
     * @var Where[]
     */
    private array $conditions = [];

    /**
     * @param array $where
     * @param string $glue
     * @return $this
     */
    public function where(array $where, string $glue = 'AND'): self
    {
        $this->conditions[] = [
            'mode' => 'AND',
            'condition' => new Where($where, $glue)
        ];
        return $this;
    }

    /**
     * @param array $where
     * @param string $glue
     * @return $this
     */
    public function andWhere(array $where, string $glue = 'AND'): self
    {
        return $this->where($where, $glue);
    }

    /**
     * @param array $where
     * @param string $glue
     * @return $this
     */
    public function orWhere(array $where, string $glue = 'AND'): self
    {
        $this->conditions[] =  [
            'mode' => 'OR',
            'condition' => new Where($where, $glue)
        ];
        return $this;
    }

    /**
     * @return string
     */
    private function getWhereSQL(): string
    {
        $where = '';
        foreach ($this->conditions as $condition) {
            $mode = $condition['mode'];
            /** @var Where $condition */
            $condition = $condition['condition'];
            if (!$condition) {
                continue;
            }

            $sql = $condition->getSQL();
            if (!$sql) {
                continue;
            }

            $glue = empty($where) ? '' : $mode;
            $where .= " {$glue} ({$condition->getSQL()})";
            $this->binds = array_merge($this->binds, $condition->getBinds());
        }

        return $where;
    }
}