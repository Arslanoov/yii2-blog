<?php

namespace blog\entities;

use blog\entities\behaviors\MetaBehavior;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;

class Page extends ActiveRecord
{
    public $meta;

    public static function tableName(): string
    {
        return '{{%pages}}';
    }

    public static function create($title, $slug, $content, Meta $meta): self
    {
        $category = new static();
        $category->title = $title;
        $category->slug = $slug;
        $category->title = $title;
        $category->content = $content;
        $category->meta = $meta;
        return $category;
    }

    public function edit($title, $slug, $content, Meta $meta): void
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->title;
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            NestedSetsBehavior::class,
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}