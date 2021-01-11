<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m210111_172133_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
        ]);

        $this->addForeignKey(
            'fk-cart-user_id-users-id',
            '{{%cart}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cart-product_id-products-id',
            '{{%cart}}',
            'product_id',
            '{{%products}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addPrimaryKey('pk-cart-user_id-product_id', '{{%cart}}', ['user_id', 'product_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-cart-user_id-users-id', '{{%cart}}');
        $this->dropForeignKey('fk-cart-product_id-products-id', '{{%cart}}');
        $this->dropPrimaryKey('pk-cart-user_id-product_id', '{{%cart}}');
        $this->dropTable('{{%cart}}');
    }
}
