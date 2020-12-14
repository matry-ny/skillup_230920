<?php

namespace app\components\db;

use app\exceptions\DBException;

/**
 * Class Update
 * @package app\components\db
 */
class Update extends AbstractQuery
{
    use WhereTrait;

    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param string $table
     * @return $this
     */
    public function setTable(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function set(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function buildSQL(): string
    {
        if (!$this->data || !$this->table) {
            throw new DBException("Update requires data and table name");
        }

        $this->binds = $this->data;

        $fields = [];
        foreach ($this->data as $field => $value) {
            $fields[] = "`{$field}` = :{$field}";
        }
        $fieldsSQL = implode(', ', $fields);

        $sql = "UPDATE `{$this->table}` SET {$fieldsSQL}";
        $where = $this->getWhereSQL();
        if ($where) {
            $sql .= " WHERE {$where}";
        }

        return $sql;
    }
}