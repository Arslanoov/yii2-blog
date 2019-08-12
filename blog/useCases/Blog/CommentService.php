<?php

namespace blog\useCases\Blog;

use blog\entities\Blog\Post\Comment;
use blog\forms\Blog\CommentForm;
use blog\repositories\Blog\PostRepository;
use blog\repositories\UserRepository;

class CommentService
{
    private $posts;
    private $users;

    public function __construct(PostRepository $posts, UserRepository $users)
    {
        $this->posts = $posts;
        $this->users = $users;
    }

    public function create($postId, $userId, CommentForm $form): Comment
    {
        $post = $this->posts->get($postId);
        $user = $this->users->get($userId);
        $comment = $post->addComment($user->id, $form->parentId, $form->text);
        $this->posts->save($post);

        return $comment;
    }
}