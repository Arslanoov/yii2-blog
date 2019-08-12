<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\TagForm */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tag-form">

    <?php $form = ActiveForm::begin() ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'name')->label('Имя') ?>
            <?= $form->field($model, 'slug')->label('Слаг') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>