<?php

namespace frontend\widgets;

use blog\entities\Blog\Post\Comment;

class CommentView
{
    public $comment;

    /**
     * @var self[]
     */
    public $children;

    public function __construct(Comment $comment, array $children)
    {
        $this->comment = $comment;
        $this->children = $children;
    }
}