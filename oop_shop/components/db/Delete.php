<?php

namespace app\components\db;

/**
 * Class Delete
 * @package app\components\db
 */
class Delete extends AbstractQuery
{
    use WhereTrait;

    /**
     * @param string $table
     * @return $this
     */
    public function from(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function buildSQL(): string
    {
        $sql = "DELETE FROM `{$this->table}`";
        $where = $this->getWhereSQL();
        if ($where) {
            $sql .= " WHERE {$where}";
        }

        return $sql;
    }
}