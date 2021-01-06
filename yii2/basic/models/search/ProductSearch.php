<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\entities\ProductEntity;

class ProductSearch extends ProductEntity
{
    public function rules(): array
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['title', 'slug'], 'safe'],
            [['price'], 'number'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = ProductEntity::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere([
                'id' => $this->id,
                'category_id' => $this->category_id,
                'price' => $this->price,
            ])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
