<?php

namespace blog\readModels\blog;

use blog\entities\Blog\Tag;
use yii\caching\FileCache;
use yii\helpers\Html;
use Yii;
use yii\helpers\Url;

class TagReadRepository
{
    public function getAll(): ?array
    {
        return Tag::find()->all();
    }

    public function getCloud($tags): ?array
    {
        $cloud = [];

        foreach ($tags as $tag) {
            $tagName = $tag->name;
            $cloud[$tagName] = ['weight' => 12, 'url' => Url::to(['/blog/post/tag', 'slug' => $tag->slug])];
        }

        return $cloud;
    }

    public function findBySlug($slug): ?Tag
    {
        return Tag::findOne([
            'slug' => $slug
        ]);
    }
}