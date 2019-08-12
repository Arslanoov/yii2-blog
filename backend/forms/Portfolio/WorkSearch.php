<?php

namespace backend\forms\Portfolio;

use blog\entities\Portfolio\Category;
use blog\entities\Portfolio\Work\Work;
use blog\helpers\PostHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class WorkSearch extends Model
{
    public $id;
    public $categoryId;
    public $date_from;
    public $date_to;
    public $link;
    public $slug;
    public $title;
    public $client;
    public $status;

    public function rules(): array
    {
        return [
            [['id', 'status', 'categoryId'], 'integer'],
            [['title', 'slug', 'client', 'link', 'slug'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Work::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->categoryId
        ]);

        $query
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['>=', 'date', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'date', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);;

        return $dataProvider;
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'title');
    }

    public function statusList(): array
    {
        return PostHelper::statusList();
    }
}