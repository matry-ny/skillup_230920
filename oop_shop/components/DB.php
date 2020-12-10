<?php

namespace app\components;

use app\components\db\Insert;
use app\components\db\Select;
use PDO;

/**
 * Class DB
 * @package app\components
 */
class DB extends AbstractComponent
{
    private PDO $connection;

    /**
     * DB constructor.
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $db
     */
    public function __construct(string $host, string $user, string $password, string $db)
    {
        $this->connection = new PDO("mysql:dbname={$db};host={$host};charset=UTF8", $user, $password);
    }

    /**
     * @param array $data
     * @return Insert
     */
    public function insert(array $data): Insert
    {
        return (new Insert($this->connection))->setData($data);
    }

    /**
     * @param array $fields
     * @return Select
     */
    public function select(array $fields = []): Select
    {
        return (new Select($this->connection))->setFields($fields);
    }
}
