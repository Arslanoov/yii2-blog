<?php

namespace blog\entities\Blog\Post;

use blog\entities\User\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%blog_comments}}';
    }

    public static function create($userId, $parentId, $text): self
    {
        $comment = new static();
        $comment->user_id = $userId;
        $comment->parent_id = $parentId;
        $comment->text = $text;
        $comment->created_at = time();
        $comment->active = true;
        return $comment;
    }

    public function edit($parentId, $text): void
    {
        $this->parent_id = $parentId;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = false;
    }

    public function isActive(): bool
    {
        return $this->active == true;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public function isChildOf($id): bool
    {
        return $this->parent_id == $id;
    }

    public function getPost(): ActiveQuery
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}