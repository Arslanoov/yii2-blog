<?php

namespace blog\readModels\Blog;

use blog\entities\Blog\Category;
use blog\entities\Blog\Post\Post;
use blog\entities\Blog\Tag;
use yii\caching\FileCache;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use Yii;

class PostReadRepository
{
    private $cache;

    public function __construct(FileCache $cache)
    {
        $this->cache = $cache;
    }
    
    public function count(): int
    {
        return Post::find()->active()->count();
    }

    public function getRelatedWorks($postId, $categoryId, $limit): array
    {
        return Post::find()->where(['category_id' => $categoryId])->andWhere(['!=', 'id', $postId])->limit($limit)->active()->all();
    }

    public function getAllByRange($offset, $limit): array
    {
        return Post::find()->active()->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    public function getAll(): DataProviderInterface
    {
        $query = Post::find()->orderBy(['created_at' => SORT_DESC])->active()->with('category');
        return $this->getProvider($query);
    }

    public function getByQuery($q): DataProviderInterface
    {
        $query = Post::find()->andWhere(['like', 'title', $q]);
        return $this->getProvider($query);
    }

    public function getAllByCategory(Category $category): DataProviderInterface
    {
        $query = Post::find()->active()->andWhere(['category_id' => $category->id])->with('category');
        return $this->getProvider($query);
    }

    public function getAllByTag(Tag $tag): DataProviderInterface
    {
        $query = Post::find()->alias('p')->active('p')->with('category');
        $query->joinWith(['tagAssignments ta'], false);
        $query->andWhere(['ta.tag_id' => $tag->id]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function getLast($limit): array
    {
        return Post::find()->with('category')->orderBy(['id' => SORT_DESC])->active()->limit($limit)->all();
    }

    public function getPopular(): ActiveDataProvider
    {
        $query = Post::find()->with('category')->orderBy(['comments_count' => SORT_DESC])->active();
        return $this->getProvider($query);
    }

    public function getLikest(): ActiveDataProvider
    {
        $query = Post::find()->with('category')->orderBy(['likes' => SORT_DESC])->active();
        return $this->getProvider($query);
    }

    public function findBySlug($id, $slug): ?Post
    {
        return Post::find()->active()->where(['id' => $id])->andWhere(['slug' => $slug])->one();
    }

    public function find($id): ?Post
    {
        return Post::find()->active()->andWhere(['id' => $id])->one();
    }

    public function search($query): ActiveDataProvider
    {
        $activeQuery = Post::find()->active()->where(['like', 'title', ($query ?? '')]);
        return $this->getProvider($activeQuery);
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => ['id'],
            ],
            'pagination' => [
                'pageSize' => 6,
                'pageSizeParam' => false
            ]
        ]);
    }
}