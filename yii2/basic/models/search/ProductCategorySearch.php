<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\entities\ProductCategoryEntity;

class ProductCategorySearch extends ProductCategoryEntity
{
    public function rules(): array
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['title'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = ProductCategoryEntity::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['id' => $this->id, 'parent_id' => $this->parent_id])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
