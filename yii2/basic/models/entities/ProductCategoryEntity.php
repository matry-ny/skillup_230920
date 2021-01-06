<?php

namespace app\models\entities;

use app\models\DropdownListTrait;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_categories".
 *
 * @property int $id
 * @property string $title
 * @property int|null $parent_id
 * @property string|null $created_at
 *
 * @property ProductCategoryEntity $parent
 * @property ProductCategoryEntity[] $children
 * @property ProductEntity[] $products
 */
class ProductCategoryEntity extends ActiveRecord
{
    use DropdownListTrait;

    public static function tableName(): string
    {
        return 'product_categories';
    }

    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['parent_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['parent_id'], 'exist', 'targetClass' => __CLASS__, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'parent_id' => Yii::t('app', 'Parent'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getParent(): ActiveQuery
    {
        return $this->hasOne(__CLASS__, ['id' => 'parent_id']);
    }

    public function getChildren(): ActiveQuery
    {
        return $this->hasMany(__CLASS__, ['parent_id' => 'id']);
    }

    public function getProducts(): ActiveQuery
    {
        return $this->hasMany(ProductEntity::class, ['category_id' => 'id']);
    }
}
