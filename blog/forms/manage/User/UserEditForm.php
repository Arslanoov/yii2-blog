<?php

namespace blog\forms\manage\User;

use Yii;
use blog\entities\User\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class UserEditForm extends Model
{
    public $photo;
    public $username;
    public $role;
    public $aboutMe;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        $this->role = $roles ? reset($roles)->name : null;
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['username', 'role'], 'required'],
            ['photo', 'image'],
            ['username', 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
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