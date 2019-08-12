<?php

namespace backend\forms\Contact;

use blog\entities\Contact\Message;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MessageSearch extends Model
{
    public $id;
    public $date_from;
    public $date_to;
    public $username;
    public $email;

    public function rules(): array
    {
        return [
            ['id', 'integer'],
            [['date_from', 'date_to'], 'date'],
            [['username', 'email'], 'safe'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Message::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['>=', 'date', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'date', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        return $dataProvider;
    }
}