<?php

namespace app\models\entities;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products_images".
 *
 * @property int $id
 * @property int $product_id
 * @property int $is_main
 * @property string $url
 * @property string|null $created_at
 *
 * @property ProductEntity $product
 */
class ProductImageEntity extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'products_images';
    }

    public function rules(): array
    {
        return [
            [['product_id', 'url'], 'required'],
            [['product_id', 'is_main'], 'integer'],
            [['created_at'], 'safe'],
            [['url'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [
                ['product_id'],
                'exist',
                'targetClass' => ProductEntity::class,
                'targetAttribute' => ['product_id' => 'id']
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product'),
            'is_main' => Yii::t('app', 'Is Main'),
            'url' => Yii::t('app', 'Url'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(ProductEntity::class, ['id' => 'product_id']);
    }
}
