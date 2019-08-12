<?php

namespace blog\entities\Blog;

use blog\entities\Blog\Post\Post;
use blog\entities\Blog\Post\TagAssignment;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Tag extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%blog_tags}}';
    }

    public static function create($name, $slug): self
    {
        $tag = new static();
        $tag->name = $name;
        $tag->slug = $slug;
        return $tag;
    }

    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public function getPosts(): ActiveQuery
    {
        return $this->hasMany(Post::class, ['id' => 'post_id'])->via('tagAssignments');
    }

    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasMany(TagAssignment::class, ['tag_id' => 'id']);
    }
}