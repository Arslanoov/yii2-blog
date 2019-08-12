<?php

namespace blog\readModels\blog;

use blog\entities\Blog\Category;
use blog\readModels\Blog\views\CategoryView;
use Yii;
use yii\caching\FileCache;

class CategoryReadRepository
{
    private $cache;

    public function __construct(FileCache $cache)
    {
        $this->cache = $cache;
    }
    
    public function getAll(): array
    {
        return Category::find()->all();
    }

    public function find($id): ?Category
    {
        return Category::findOne($id);
    }

    public function findBySlug($slug): ?Category
    {
        return Category::find()->andWhere(['slug' => $slug])->one();
    }

    public function getRoot(): Category
    {
        return Category::find()->roots()->one();
    }

    public function getCategoriesList(): array
    {
        return Category::find()->where(['>', 'lft', '0'])->asArray()->all();
    }

    public function getCategories(): array
    {
        return Category::find()->where(['>', 'lft', '0'])->all();
    }

    public function getTreeWithSubsOf(): array
    {
        $query = Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft');

        return array_map(function (Category $category) {
            return new CategoryView($category, $category->getPosts()->count());
        }, $query->all());
    }
}