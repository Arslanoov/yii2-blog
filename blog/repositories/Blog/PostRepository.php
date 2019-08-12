<?php

namespace blog\repositories\Blog;

use blog\entities\Blog\Post\Post;
use blog\repositories\NotFoundException;
use RuntimeException;

class PostRepository
{
    public function get($id): Post
    {
        return $this->getBy(['id' => $id]);
    }

    public function existsByCategory($id): bool
    {
        return Post::find()->where(['category_id' => $id])->exists();
    }

    public function save(Post $post): void
    {
        if (!$post->save()) {
            throw new RuntimeException('Не получилось сохранить публикацию');
        }
    }

    public function remove(Post $post): void
    {
        if (!$post->delete()) {
            throw new RuntimeException('Не получилось удалить публикацию');
        }
    }

    private function getBy(array $condition): ?Post
    {
        if (!$post = Post::find()->where($condition)->one()) {
            throw new NotFoundException('Публикация не найдена');
        }
        return $post;
    }
}