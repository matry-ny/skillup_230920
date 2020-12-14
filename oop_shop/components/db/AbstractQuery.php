<?php

namespace app\components\db;

use PDO;
use app\exceptions\DBException;
use PDOStatement;

/**
 * Class AbstractQuery
 * @package app\components\db
 */
abstract class AbstractQuery
{
    private PDO $connection;
    protected string $table = '';
    protected array $binds = [];

    /**
     * @var PDOStatement|false
     */
    protected $stmt = false;

    /**
     * Insert constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return bool
     * @throws DBException
     */
    public function execute(): bool
    {
        $this->stmt = $this->connection->prepare($this->buildSQL());
        $result = $this->stmt->execute($this->binds);

        if (!$result) {
            $error = json_encode($this->stmt->errorInfo());
            throw new DBException("{$this->stmt->errorCode()}: {$error}");
        }

        return true;
    }

    /**
     * @return string
     */
    abstract protected function buildSQL(): string;
}