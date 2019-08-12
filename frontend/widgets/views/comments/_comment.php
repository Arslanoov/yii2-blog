<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $item frontend\widgets\CommentView */

$comment = $item->comment;

?>

<div class="comment-wrap comment-item" data-id="<?= $comment->id ?>" id="comment_<?= $comment->id ?>">

    <div class="single-comment-box">

        <div class="img-box">
            <img src="<?= $comment->author->getThumbFileUrl('photo', 'single_comment') ?>" alt="">
        </div>

        <div class="text-box">
            <h3>
                <?php if ($comment->author): ?>
                    <a href="<?= Url::to(['/cabinet/default/view', 'id' => $comment->author->id]) ?>" target="_blank">
                        <?= Html::encode($comment->author->username) ?>
                    </a>
                <?php else: ?>
                    <em>Account was deleted</em>
                <?php endif; ?>

                <span class="sep">-</span><span><?= date('d M, Y', $comment->created_at) ?></span>

            </h3>
            <p>
                <?php if ($comment->isActive()): ?>
                    <?= Yii::$app->formatter->asNtext($comment->text) ?>
                <?php else: ?>
                    <i>Comment was deleted</i>
                <?php endif; ?>
            </p>

            <?php if (!Yii::$app->user->isGuest): ?>
                <span class="comment-reply">
                    <a href="#" class="reply">Reply</a>
                </span>
            <?php endif; ?>

        </div>

    </div>

    <div class="reply-block"></div>

    <?php foreach ($item->children as $children): ?>
        <div class="comment-childs">
            <?= $this->render('_comment', ['item' => $children]) ?>
        </div>
    <?php endforeach; ?>

</div>