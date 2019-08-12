<?php

namespace frontend\widgets;

use blog\readModels\Blog\Post\CommentReadRepository;
use yii\base\Widget;

class RecentCommentsWidget extends Widget
{
    private $repository;

    public function __construct(CommentReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run(): string
    {
        $comments = $this->repository->getLastest();
        return $this->render('comments/latest/comments', [
            'comments' => $comments
        ]);
    }
}