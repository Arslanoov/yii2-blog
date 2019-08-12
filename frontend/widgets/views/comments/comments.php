<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $post blog\entities\Blog\Post\Post */
/** @var $items frontend\widgets\CommentView[] */
/** @var $commentForm blog\forms\Blog\CommentForm */

?>

<section class="white same-color-as-previous-section">

    <h2 class="little-padding-bottom">Choose comments section</h2>

    <ul id="tab1" class="nav nav-tabs">
        <li class="active"><a href="#tab1-item1" data-toggle="tab">Website</a></li>
        <li><a href="#tab1-item2" data-toggle="tab">VK</a></li>
        <li><a href="#tab1-item3" data-toggle="tab">Facebook</a></li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade active in" id="tab1-item1">
            <div id="comments">
                <div class="comment-box">
                    <div class="title-box">
                        <h3><?= $post->comments_count ?> Comments</h3>
                    </div>

                    <?php foreach ($items as $item): ?>
                        <?= $this->render('_comment', ['item' => $item]) ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if (!Yii::$app->user->isGuest): ?>

                <div id="reply-block" class="leave-reply">

                    <div class="leave-comment">

                        <div class="title-box">
                            <h3>Leave a Comment</h3>
                        </div>

                        <?php $form = ActiveForm::begin([
                            'action' => ['comment', 'id' => $post->id],
                            'id' => 'comment-reply',
                            'options' => [
                                'class' => 'comment-form',
                            ],
                        ]) ?>

                            <?= Html::activeHiddenInput($commentForm, 'parentId') ?>

                            <div class="col-md-12 comment-text">
                                <?= $form->field($commentForm, 'text')->textarea([
                                    'placeholder' => 'Write Your message'
                                ])->label(false) ?>

                                <?= Html::submitButton('Post Comment', [
                                    'class' => 'button'
                                ]) ?>
                            </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>

            <?php else: ?>
                <div class="col-sm-12">
                    <div class="text-center">
                        <p>You must be logged in to leave a comment</p>
                    </div>
                </div>
            <?php endif; ?>

            <?php $this->registerJs('
                jQuery(document).on("click", "#comments .comment-reply", function () {
                    var link = jQuery(this);
                    var form = jQuery("#reply-block");
                    var comment = link.closest(".comment-item");
                    jQuery("#commentform-parentid").val(comment.data("id"));
                    form.detach().appendTo(comment.find(".reply-block:first"));
                    return false;
                });
            '); ?>

        </div>

        <div class="tab-pane fade margin-top" id="tab1-item2">
            <div id="vk_comments"></div>
            <?php $this->registerJs('
                VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
            ') ?>
        </div>

        <div class="tab-pane fade margin-top" id="tab1-item3">
            <div class="fb-comments" data-href="http://blog.dev" data-width="80%" data-numposts="5"></div>
        </div>

    </div>

</section>