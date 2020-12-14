<?php

namespace app\models;

/**
 * Class AccessLog
 * @package app\models
 */
class AccessLog extends \app\components\db\ActiveRecord
{
    /**
     * @inheritDoc
     */
    protected function tableName(): string
    {
        return 'access_log';
    }
}