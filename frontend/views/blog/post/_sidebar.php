<?php

/** @var $this \yii\web\View */
/** @var $cloud array */

use frontend\widgets\RecentPostsWidget;
use frontend\widgets\CategoriesWidget;
use asu\tagcloud\TagCloud;
use yii\helpers\Url;

?>

<div class="sidebar sidebar-right">

    <div class="single-sidebar search-sidebar">
        <form action="<?= Url::to(['/blog/post/search']) ?>" class="search-form">
            <input type="text" placeholder="Search here..." name="q">
            <button class="fa fa-search" type="submit"></button>
        </form>
    </div>

    <?= RecentPostsWidget::widget() ?>

    <?= CategoriesWidget::widget() ?>

    <div class="single-sidebar tags-sidebar">
        <div class="title">
            <h3>Tags</h3>
        </div>

        <?= TagCloud::widget([
            'beginColor' => '#7A7F93',
            'endColor' => '#7A7F93',
            'minFontSize' => 14,
            'maxFontSize' => 14,
            'tags' => $cloud,
            'options' => [
                'class' => 'tags-lists'
            ]
        ]) ?>
    </div>
</div>