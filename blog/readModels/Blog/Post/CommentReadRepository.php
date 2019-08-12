<?php

namespace blog\readModels\Blog\Post;

use blog\entities\Blog\Post\Comment;
use yii\caching\FileCache;

class CommentReadRepository
{
    private $cache;

    public function __construct(FileCache $cache)
    {
        $this->cache = $cache;
    }

    public function getLastest(): array
    {
        return $this->cache->getOrSet('latestComments', function () {
            return Comment::find()->where(['active' => '1'])->orderBy('created_at DESC')->limit(4)->all();
        }, 3600);
    }
}