<?php

namespace blog\entities\behaviors;

use blog\entities\Meta;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class MetaBehavior
 * @package blog\entities\behaviors
 */
class MetaBehavior extends Behavior
{
    /** @var string */
    public $attribute = 'meta';
    /** @var string */
    public $jsonAttribute = 'meta_json';

    /**
     * @return array
     */
    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    }

    /**
     * @param Event $event
     */
    public function onAfterFind(Event $event): void
    {
        $model = $event->sender;
        if ($model->getAttribute($this->jsonAttribute)) {
            $meta = Json::decode($model->getAttribute($this->jsonAttribute));
            $model->{$this->attribute} = new Meta(
                ArrayHelper::getValue($meta, 'title'),
                ArrayHelper::getValue($meta, 'description'),
                ArrayHelper::getValue($meta, 'keywords')
            );
        }
    }

    /**
     * @param Event $event
     */
    public function onBeforeSave(Event $event): void
    {
        $model = $event->sender;
        $model->setAttribute('meta_json', Json::encode([
            'title' => $model->{$this->attribute}->title,
            'description' => $model->{$this->attribute}->description,
            'keywords' => $model->{$this->attribute}->keywords,
        ]));
    }
}