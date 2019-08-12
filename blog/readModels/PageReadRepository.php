<?php

namespace blog\readModels;

use blog\entities\Page;
use yii\caching\FileCache;

class PageReadRepository
{
    public function getAll(): array
    {
        return Page::find()->andWhere(['>', 'depth', 0])->all();
    }

    public function getChildren(Page $page): array
    {
        return Page::find()->where(['>', 'lft', $page->lft])->andWhere(['<', 'rgt', $page->rgt])->all();
    }

    public function find($id): ?Page
    {
        return Page::findOne($id);
    }

    public function findBySlug($slug): ?Page
    {
        return Page::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }
}