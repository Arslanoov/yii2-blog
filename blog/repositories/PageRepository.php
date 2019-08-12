<?php

namespace blog\repositories;

use blog\entities\Page;
use RuntimeException;

class PageRepository
{
    public function get($id): Page
    {
        if (!$page = Page::findOne($id)) {
            throw new NotFoundException('Страница не найдена');
        }
        return $page;
    }

    public function save(Page $page): void
    {
        if (!$page->save()) {
            throw new RuntimeException('Не получилось сохранить страницу');
        }
    }

    public function remove(Page $page): void
    {
        if (!$page->delete()) {
            throw new RuntimeException('Не получилось удалить страницу');
        }
    }
}