<?php

namespace app\components\db;

use app\exceptions\DBException;

/**
 * Class Insert
 * @package app\components\db
 */
class Insert extends AbstractQuery
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function into(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return string
     * @throws DBException
     */
    protected function buildSQL(): string
    {
        if (!$this->data || !$this->table) {
            throw new DBException("Insert requires data and table name");
        }

        $keys = array_keys($this->data);

        $fields = '`' . implode('`, `', $keys) . '`';
        $aliases = ':' . implode(', :', $keys);

        $this->binds = $this->data;

        return "INSERT INTO `{$this->table}` ({$fields}) VALUES ({$aliases})";
    }
}
