<?php

namespace frontend\widgets;

use blog\readModels\blog\PostReadRepository;
use yii\base\Widget;

class RecentPostsWidget extends Widget
{
    public $limit;

    private $repository;

    public function __construct(PostReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run(): string
    {
        $posts = $this->repository->getLast($this->limit);

        return $this->render('last-posts', [
            'posts' => $posts
        ]);
    }
}