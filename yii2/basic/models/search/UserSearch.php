<?php

namespace app\models\search;

use DateTime;
use yii\data\ActiveDataProvider;
use app\models\entities\UserEntity;

class UserSearch extends UserEntity
{
    public function rules(): array
    {
        return [
            [['id', 'is_active'], 'integer'],
            [['username', 'login', 'password', 'created_at'], 'safe'],
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
            ])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'login', $this->login]);

        if ($this->created_at) {
            $date = new DateTime($this->created_at);
            $start = $date->format('Y-m-d 00:00:00');
            $end = $date->format('Y-m-d 23:59:59');

            $query->andFilterWhere(['between', 'created_at', $start, $end]);
        }

        return $dataProvider;
    }
}
