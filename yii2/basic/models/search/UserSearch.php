<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\entities\UserEntity;

class UserSearch extends UserEntity
{
    public function rules(): array
    {
        return [
            [['id', 'is_active'], 'integer'],
            [['name', 'login', 'password', 'created_at'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = UserEntity::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere([
                'id' => $this->id,
                'is_active' => $this->is_active,
                'created_at' => $this->created_at,
            ])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'login', $this->login]);

        return $dataProvider;
    }
}
