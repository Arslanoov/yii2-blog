<?php

namespace blog\entities\Blog\Post;

use yii\db\ActiveRecord;

class Like extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%blog_post_likes}}';
    }

    public static function create($userId, $postId): self
    {
        $like = new static();
        $like->user_id = $userId;
        $like->post_id = $postId;
        return $like;
    }
}