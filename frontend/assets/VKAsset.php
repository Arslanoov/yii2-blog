<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class VKAsset extends AssetBundle
{
    public $js = [
        'https://vk.com/js/api/openapi.js?161',
        'js/vk/comments.js'
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
}