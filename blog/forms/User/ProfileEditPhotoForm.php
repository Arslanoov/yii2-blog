<?php

namespace blog\forms\User;

use yii\base\Model;
use yii\web\UploadedFile;

class ProfileEditPhotoForm extends Model
{
    public $photo;

    public function rules(): array
    {
        return [
            ['photo', 'image'],
        ];
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