<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m201221_191657_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'login' => $this->string(100)->notNull(),
            'password' => $this->string(255)->notNull(),
            'is_active' => $this->boolean()->defaultValue(false),
            'created_at' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
