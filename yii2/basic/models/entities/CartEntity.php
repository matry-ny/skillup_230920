<?php

namespace app\models\entities;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cart".
 *
 * @property int $user_id
 * @property int $product_id
 * @property int $count
 * @property string $created_at
 *
 * @property ProductEntity $product
 * @property UserEntity $user
 */
class CartEntity extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id', 'count'], 'integer'],
            [['user_id', 'product_id'], 'unique', 'targetAttribute' => ['user_id', 'product_id']],
            [
                ['product_id'],
                'exist',
                'targetClass' => ProductEntity::class,
                'targetAttribute' => ['product_id' => 'id'],
            ],
            [['user_id'], 'exist', 'targetClass' => UserEntity::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'count' => Yii::t('app', 'Count'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(ProductEntity::class, ['id' => 'product_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(UserEntity::class, ['id' => 'user_id']);
    }
}
