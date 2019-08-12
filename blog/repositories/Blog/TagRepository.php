<?php

namespace blog\repositories\Blog;

use blog\repositories\NotFoundException;
use RuntimeException;
use blog\entities\Blog\Tag;

class TagRepository
{
    public function get($id): ?Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Метка не найдена');
        }

        return $tag;
    }

    public function findByName($name): ?Tag
    {
        return Tag::findOne([
            'name' => $name
        ]);
    }

    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new RuntimeException('Не получилось сохранить метку');
        }
    }

    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new RuntimeException('Не получилось удалить метку');
        }
    }
}