<?php

namespace blog\repositories\Blog;

use blog\entities\Blog\Category;
use blog\repositories\NotFoundException;
use RuntimeException;

class CategoryRepository
{
    public function get($id): ?Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Категория не найдена');
        }

        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new RuntimeException('Не получилось сохранить категорию');
        }
    }

    public function delete(Category $category): void
    {
        if (!$category->delete()) {
            throw new RuntimeException('Не получилось удалить категорию');
        }
    }
}