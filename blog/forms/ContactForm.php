<?php

namespace blog\forms;

use yii\base\Model;

class ContactForm extends Model
{
    public $username;
    public $email;
    public $message;

    public function rules(): array
    {
        return [
            [['username', 'email', 'message'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
            ['message', 'trim']
        ];
    }
}