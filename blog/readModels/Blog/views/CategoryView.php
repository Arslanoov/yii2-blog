<?php

namespace blog\readModels\Blog\views;

use blog\entities\Blog\Category;

class CategoryView
{
    public $category;
    public $count;

    public function __construct(Category $category, $count)
    {
        $this->category = $category;
        $this->count = $count;
    }
}