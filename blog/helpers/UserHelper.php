<?php

namespace blog\helpers;

use blog\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class UserHelper
 * @package blog\helpers
 */
class UserHelper
{
    /**
     * @return array
     */
    public static function statusList(): array
    {
        return [
            User::STATUS_WAIT => 'Wait',
            User::STATUS_ACTIVE => 'Active',
            User::STATUS_BANNED => 'Banned'
        ];
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusLabel($status): string
    {
        switch ($status) {
            case User::STATUS_WAIT:
                $class = 'label label-default';
                break;
            case User::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case User::STATUS_BANNED:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}