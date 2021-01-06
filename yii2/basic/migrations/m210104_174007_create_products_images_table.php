<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%products_images}}`.
 */
class m210104_174007_create_products_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_images}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'is_main' => $this->boolean()->notNull()->defaultValue(false),
            'url' => $this->string(255)->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        $this->addForeignKey(
            'fk-products_images-product_id-products-id',
            'products_images',
            'product_id',
            'products',
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
        $this->dropForeignKey('fk-products_images-product_id-products-id', 'products_images');
        $this->dropTable('{{%products_images}}');
    }
}
