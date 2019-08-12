<?php

namespace blog\forms\Blog;

use yii\base\Model;

class SearchForm extends Model
{
    public $q;

    public function rules(): array
    {
        return [
            ['q', 'safe']
        ];
    }
}