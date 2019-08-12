<?php

namespace blog\repositories\Blog;

use blog\entities\Blog\Post\Like;
use DomainException;

class LikeRepository
{
    public function get($userId, $postId): ?Like
    {
        return Like::find()->where(['user_id' => $userId])->andWhere(['post_id' => $postId])->limit(1)->one();
    }

    public function likeExists($userId, $postId): bool
    {
        return Like::find()->where(['user_id' => $userId])->andWhere(['post_id' => $postId])->exists();
    }

    public function save(Like $like): void
    {
        if (!$like->save()) {
            throw new DomainException('Не удалось поставить лайк');
        }
    }

    public function remove(Like $like): void
    {
        if (!$like->delete()) {
            throw new DomainException('Не удалось убрать лайк');
        }
    }
}