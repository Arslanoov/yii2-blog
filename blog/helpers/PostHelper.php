<?php

namespace blog\helpers;

use blog\entities\Blog\Post\Post;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class PostHelper
 * @package blog\helpers
 */
class PostHelper
{
    /**
     * Список статусов
     * @return array
     */
    public static function statusList(): array
    {
        return [
            Post::STATUS_DRAFT => 'Draft',
            Post::STATUS_ACTIVE => 'Active',
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
            case Post::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Post::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}