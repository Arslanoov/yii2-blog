<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/** @var $comment \blog\entities\Blog\Post\Comment */

?>

<div class="media">
    <div class="pull-left">
        <?php if ($comment->author->photo): ?>
            <img src="<?= $comment->author->getThumbFileUrl('photo', 'widget') ?>" alt="">
        <?php endif; ?>
    </div>
    <div class="media-body">
        <h4><a href="<?= Url::to([
                Yii::$app->language .
                '/blog/' . $comment->post->id . '-' . $comment->post->slug,
                '#' => 'comment_' . $comment->id
            ]) ?>"><?= Html::encode(StringHelper::truncateWords(strip_tags($comment->text), 10)) ?></a></h4>
        <p><?= Yii::t('app', 'опубликован') ?> <?= Yii::$app->formatter->asDatetime($comment->created_at) ?></p>
    </div>
</div>
