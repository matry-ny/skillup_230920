<?php

namespace app\components\db;

use app\components\App;
use app\exceptions\DBException;
use app\exceptions\InvalidConfigException;
use PDO;

/**
 * Class ActiveRecord
 * @package app\components\db
 */
abstract class ActiveRecord
{
    private PDO $connection;
    private array $fields = [];
    private ?string $primaryKey = null;
    private bool $isNewRecord = true;
    protected array $extendedFields = [];
    private array $errors = [];

    public function __construct()
    {
        $this->connection = App::get()->db()->getConnection();

        $this->setUpFields();
        $this->setUpPrimaryKey();
    }

    /**
     * @return string
     */
    abstract protected function tableName(): string;

    /**
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * @param array $conditions
     * @return static
     * @throws DBException
     * @throws InvalidConfigException
     */
    public static function findOne(array $conditions): self
    {
        $model = new static();
        $data = App::get()->db()->select(['*'])->from($model->tableName())->where($conditions)->one();
        $model->load($data);
        $model->isNewRecord = false;

        return $model;
    }

    /**
     * @param array $conditions
     * @return self[]
     * @throws DBException
     * @throws InvalidConfigException
     */
    public static function findAll(array $conditions): array
    {
        $model = new static();
        $data = App::get()->db()->select(['*'])->from($model->tableName())->where($conditions)->all();

        $result = [];
        foreach($data as $row) {
            $model = new static();
            $model->load($row);
            $model->isNewRecord = false;
            $result[] = $model;
        }

        return $result;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->fields[$name] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        if (!array_key_exists($name, $this->fields)) {
            return;
        }

        $this->fields[$name] = $value;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name): bool
    {
        return array_key_exists($name, $this->fields);
    }

    /**
     * @return bool
     * @throws DBException
     * @throws InvalidConfigException
     */
    public function save(): bool
    {
        $validator = App::get()->validator($this->getValidationFields(), $this->rules())->run();
        $this->errors = $validator->getErrors();
        if ($this->errors) {
            return false;
        }

        if ($this->isNewRecord) {
            return $this->create();
        }

        return $this->update();
    }

    /**
     * @return bool
     * @throws DBException
     * @throws InvalidConfigException
     */
    public function delete(): bool
    {
        App::get()
            ->db()
            ->delete()
            ->from($this->tableName())
            ->where([[$this->primaryKey, '=', $this->{$this->primaryKey}]])
            ->execute();

        $this->setUpFields();
        $this->isNewRecord = true;

        return true;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    private function getValidationFields(): array
    {
        $fields = $this->fields;
        foreach ($this->extendedFields as $extendedField) {
            $fields[$extendedField] = $this->{$extendedField};
        }

        return $fields;
    }

    /**
     * @return bool
     * @throws DBException
     * @throws InvalidConfigException
     */
    private function update(): bool
    {
        App::get()
            ->db()
            ->update($this->tableName())
            ->set($this->fields)
            ->where([[$this->primaryKey, '=', $this->{$this->primaryKey}]])
            ->execute();

        return $this->reload($this->{$this->primaryKey});
    }

    /**
     * @return bool
     * @throws DBException
     * @throws InvalidConfigException
     */
    private function create(): bool
    {
        $fields = array_filter($this->fields, static function ($value) {
            return $value !== null;
        });

        $connection = App::get()->db()->getConnection();
        $connection->beginTransaction();
        try {
            App::get()->db()->insert($fields)->into($this->tableName())->execute();
            $newId = App::get()->db()->getConnection()->lastInsertId();
            $connection->commit();
        } catch (\Exception $exception) {
            $connection->rollBack();
            return false;
        }

        return $this->reload($newId);
    }

    /**
     * @param int|string $primaryKeyValue
     * @return bool
     * @throws DBException
     * @throws InvalidConfigException
     */
    private function reload($primaryKeyValue): bool
    {
        $this->isNewRecord = false;
        $data = App::get()
            ->db()
            ->select(['*'])
            ->from($this->tableName())
            ->where([[$this->primaryKey, '=', $primaryKeyValue]])
            ->one();

        return $this->load($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function load(array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        foreach ($data as $key => $value) {
            if (!isset($this->{$key})) {
                continue;
            }

            $this->{$key} = $value;
        }

        return true;
    }

    private function setUpFields(): void
    {
        $stmt = $this->connection->query("DESCRIBE `{$this->tableName()}`");
        $this->fields = array_fill_keys($stmt->fetchAll(PDO::FETCH_COLUMN), null);
    }

    private function setUpPrimaryKey(): void
    {
        $stmt = $this->connection->query("SHOW KEYS FROM `{$this->tableName()}` WHERE Key_name = 'PRIMARY'");
        $this->primaryKey = $stmt->fetch(PDO::FETCH_ASSOC)['Column_name'] ?? null;
    }
}
