<?php

namespace blog\forms\auth;

use yii\base\Model;
use blog\entities\User\User;

class PasswordResetRequestForm extends Model
{
    public $email;

    public function rules(): array
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::class,
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Пользователя с такой почтой не существует'
            ],
        ];
    }
}
