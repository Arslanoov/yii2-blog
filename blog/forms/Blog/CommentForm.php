<?php

namespace blog\forms\Blog;

use yii\base\Model;

class CommentForm extends Model
{
    public $parentId;
    public $text;

    public function rules(): array
    {
        return [
            ['text', 'required'],
            ['parentId', 'integer'],
            ['text', 'string'],
            ['text', 'string', 'max' => 450]
        ];
    }
}