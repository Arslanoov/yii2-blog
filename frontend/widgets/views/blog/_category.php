<?php

/** @var $item blog\entities\Blog\Category */

use yii\helpers\Url;
use yii\helpers\Html;
use blog\helpers\StringHelper;

?>

<li>
    <a href="<?= Url::to(['/blog/post/category', 'slug' => $item->slug]) ?>" class="<?= Url::current() == Url::to(['/blog/post/category', 'slug' => $item->slug]) ? 'current' : '' ?>">
        <?= StringHelper::cut(Html::encode($item->name), 20) ?>
        <?php if (!empty($item->name)): ?>
            <i class="fa fa-angle-right"></i>
        <?php endif; ?>
    </a>
</li>