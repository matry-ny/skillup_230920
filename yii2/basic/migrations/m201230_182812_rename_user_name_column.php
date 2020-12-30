<?php

use yii\db\Migration;

/**
 * Class m201230_182812_rename_user_name_column
 */
class m201230_182812_rename_user_name_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%users}}', 'name', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%users}}', 'username', 'name');
    }
}
