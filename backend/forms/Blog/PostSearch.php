<?php

namespace backend\forms\Blog;

use blog\entities\Blog\Category;
use blog\helpers\PostHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use blog\entities\Blog\Post\Post;
use yii\helpers\ArrayHelper;

class PostSearch extends Model
{
    public $id;
    public $categoryId;
    public $date_from;
    public $date_to;
    public $title;
    public $slug;
    public $status;

    public function rules(): array
    {
        return [
            [['id', 'status', 'categoryId'], 'integer'],
            [['title', 'slug'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Post::find();
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
            'category_id' => $this->categoryId,
        ]);

        $query
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

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