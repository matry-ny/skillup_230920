<?php


namespace app\components\db;


use app\components\App;
use PDO;

/**
 * Class ActiveRecord
 * @package app\components\db
 */
abstract class ActiveRecord
{
    private PDO $connection;
    private array $fields = [];

    public function __construct()
    {
        $this->connection = App::get()->db()->getConnection();

        $this->setUpFields();
    }

    /**
     * @return string
     */
    abstract protected function tableName(): string;

    private function setUpFields(): void
    {
        $sql = $this->connection->prepare("DESCRIBE `{$this->tableName()}`");
        $sql->execute();
        $this->fields = array_fill_keys($sql->fetchAll(PDO::FETCH_COLUMN), null);
    }
}
