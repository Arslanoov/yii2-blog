<?php

namespace blog\forms\manage\User;

use blog\entities\User\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\UploadedFile;

class UserCreateForm extends Model
{
    public $photo;
    public $username;
    public $email;
    public $password;
    public $aboutMe;
    public $role;

    public function rules(): array
    {
        return [
            [['username', 'email', 'role'], 'required'],
            ['email', 'email'],
            ['photo', 'image'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
            ['aboutMe', 'string', 'max' => 500]
        ];
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');
            return true;
        }
        return false;
    }
}