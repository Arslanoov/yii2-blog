<?php

/* @var $this yii\web\View */
/* @var $model blog\entities\Blog\Post\Post */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

$url = Url::to(['/blog/post/single', 'id' => $model->id, 'slug' => $model->slug]);

?>

<div class="col-lg-6 col-12">
    <div class="single-blog-style-one">
        <div class="img-box">
            <?php if ($model->photo): ?>
                <img src="<?= $model->getThumbFileUrl('photo', 'blog_list') ?>" alt="" />
            <?php endif; ?>
            <a href="<?= $url ?>" class="read-more">+</a>
            <div class="date-box">
                <?= date('d M', $model->created_at) ?>
            </div>
            <div class="like-box">
                <a href="#" onclick="false" class="like" data-post="<?= $model->id ?>">
                    <span id="likes_post_<?= $model->id ?>"><?= $model->likes ?></span> <br>
                    <i class="fa fa-heart"></i>
                </a>
            </div>
        </div>
        <div class="text-box">
            <a href="<?= $url ?>">
                <h3><?= Html::encode($model->title) ?></h3>
            </a>
            <p><?= Html::encode(StringHelper::truncateWords(strip_tags($model->description), 20)) ?></p>
        </div>
    </div>
</div>