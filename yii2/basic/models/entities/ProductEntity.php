<?php

namespace app\models\entities;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $slug
 * @property float $price
 * @property string|null $created_at
 *
 * @property ProductCategoryEntity $category
 * @property ProductImageEntity[] $images
 */
class ProductEntity extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'products';
    }

    public function rules(): array
    {
        return [
            [['category_id', 'title', 'price'], 'required'],
            [['category_id'], 'integer'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [
                ['category_id'],
                'exist',
                'targetClass' => ProductCategoryEntity::class,
                'targetAttribute' => ['category_id' => 'id']
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(ProductCategoryEntity::class, ['id' => 'category_id']);
    }

    public function getImages(): ActiveQuery
    {
        return $this->hasMany(ProductImageEntity::class, ['product_id' => 'id']);
    }

    public function getMainImage(): ?ProductImageEntity
    {
        return $this->images[0] ?? null;
    }
}
