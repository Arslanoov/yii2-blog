<?php

/** @var $posts blog\entities\Blog\Post\Post[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<div class="single-sidebar recent-post-sidebar">
    <div class="title">
        <h3>Latest Posts</h3>
    </div>

    <?php foreach ($posts as $post): ?>
        <?php $url = Url::to(['/blog/post/single', 'id' => $post->id, 'slug' => $post->slug]); ?>

        <div class="single-recent-post">
            <div class="img-box">
                <img src="<?= Html::encode($post->getThumbFileUrl('photo', 'widget')) ?>" alt="">
            </div>
            <div class="text-box">
                <a href="<?= $url ?>">
                    <h4><?= Html::encode($post->title) ?></h4>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>