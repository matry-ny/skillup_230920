<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_categories}}`.
 */
class m210104_170854_create_product_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_categories}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->unique(),
            'parent_id' => $this->integer()->null(),
            'created_at' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        $this->addForeignKey(
            'fk-product_categories-parent_id-id',
            '{{%product_categories}}',
            'parent_id',
            '{{%product_categories}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product_categories-parent_id-id', '{{%product_categories}}');
        $this->dropTable('{{%product_categories}}');
    }
}
