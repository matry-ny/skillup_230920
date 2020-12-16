<?php

namespace app\components\db;

use app\exceptions\DBException;
use PDO;

/**
 * Class Select
 * @package app\components\db
 */
class Select extends AbstractQuery
{
    use WhereTrait;

    private array $fields = [];

    /**
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

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
     * @param int $mode
     * @return array
     * @throws DBException
     */
    public function all(int $mode = PDO::FETCH_ASSOC): array
    {
        $this->execute();
        if (!$this->stmt) {
            return [];
        }

        return $this->stmt->fetchAll($mode);
    }

    /**
     * @param int $mode
     * @return array|null
     * @throws DBException
     */
    public function one(int $mode = PDO::FETCH_ASSOC): ?array
    {
        $this->execute();
        if (!$this->stmt) {
            return null;
        }

        return $this->stmt->fetch($mode) ?: null;
    }

    /**
     * @return string
     */
    public function buildSQL(): string
    {
        $fields = implode(', ', $this->fields);
        $sql = "SELECT {$fields} FROM `{$this->table}`";

        $where = $this->getWhereSQL();
        if ($where) {
            $sql .= " WHERE {$where}";
        }

        return $sql;
    }
}