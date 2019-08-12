<?php

namespace blog\entities\Contact;

use yii\db\ActiveRecord;

class Message extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%messages}}';
    }

    public static function create($username, $email, $message): self
    {
        $item = new static();
        $item->date = date('Y-m-d h:i:s');
        $item->username = $username;
        $item->email = $email;
        $item->message = $message;
        return $item;
    }
}