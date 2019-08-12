<?php

/** @var $item blog\entities\Blog\Category */

use yii\helpers\Url;
use yii\helpers\Html;
use blog\helpers\StringHelper;

?>

<li class="big-line-height">
    <a href="<?= Url::to(['/blog/post/category', 'slug' => $item->slug]) ?>" class="<?= (Url::current() == '/portfolio/category/' . $item->slug) ? 'active' : '' ?>">
        <?= StringHelper::cut(Html::encode($item->name), 20) ?>
    </a>
<li>

