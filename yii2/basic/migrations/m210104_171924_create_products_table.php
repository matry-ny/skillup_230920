<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m210104_171924_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'price' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        $this->addForeignKey(
            'fk-products-category_id-product_categories-id',
            '{{%products}}',
            'category_id',
            '{{%product_categories}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products-category_id-product_categories-id', '{{%products}}');
        $this->dropTable('{{%products}}');
    }
}
