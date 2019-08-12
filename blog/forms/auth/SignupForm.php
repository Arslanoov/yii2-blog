<?php

namespace blog\forms\auth;

use blog\entities\User\User;
use yii\base\Model;
use yii\web\UploadedFile;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $aboutMe;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'blog\entities\User\User', 'message' => 'Пользователь с таким именем уже существует.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Пользователь с такой почтой уже существует.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['aboutMe', 'string', 'max' => 500]
        ];
    }
}
