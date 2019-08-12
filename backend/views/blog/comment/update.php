<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $post blog\entities\Blog\Post\Post */
/* @var $model blog\forms\manage\Blog\Post\CommentEditForm */

$this->title = 'Обновление комментария';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Комментарии',
    'url' => ['index']
];
$this->params['breadcrumbs'][]= 'Обновление комментария';

?>

<div class="comment-update">

    <h1>Обновление комментария</h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'parentId')->textInput()->label('Родительский Комментарий') ?>
            <?= $form->field($model, 'text')->textarea(['rows' => 20])->label('Содержание') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>