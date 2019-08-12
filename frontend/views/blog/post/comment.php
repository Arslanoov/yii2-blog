<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $post blog\entities\Blog\Post\Post */
/* @var $model blog\forms\Blog\CommentForm */

?>

<div class="content-form">
    <?php $form = ActiveForm::begin([
        'action' => ['comment', 'id' => $post->id],
    ]); ?>

    <?= Html::activeHiddenInput($model, 'parentId') ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить') ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>