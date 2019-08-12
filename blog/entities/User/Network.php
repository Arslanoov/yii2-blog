<?php

namespace blog\entities\User;

use Webmozart\Assert\Assert;
use yii\db\ActiveRecord;

class Network extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%user_networks}}';
    }

    public static function create($network, $identity): self
    {
        Assert::notEmpty($network);
        Assert::notEmpty($identity);
        $item = new static();
        $item->network = $network;
        $item->identity = $identity;

        return $item;
    }

    public function isFor($network, $identity): bool
    {
        return $this->network === $network && $this->identity === $identity;
    }
}