<?php

namespace frontend\widgets;

use blog\readModels\blog\CategoryReadRepository;
use blog\readModels\Blog\views\CategoryView;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class CategoriesWidget extends Widget
{
    private $repository;

    public function __construct(CategoryReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run(): string
    {
        $categories = $this->repository->getCategories();

        return $this->render('blog/categories', [
            'categories' => $categories
        ]);
    }
}