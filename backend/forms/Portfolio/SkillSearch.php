<?php

namespace backend\forms\Portfolio;

use blog\entities\Portfolio\Skill;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SkillSearch extends Model
{
    public $id;
    public $name;
    public $slug;

    public function rules(): array
    {
        return [
            ['id', 'integer'],
            [['name', 'slug'], 'safe']
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Skill::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}