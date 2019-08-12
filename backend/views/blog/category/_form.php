<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\CategoryForm */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'parentId')->dropDownList($model->parentCategoriesList())->label('Родительская категория') ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label('Слаг') ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>
            <?= $form->field($model, 'description')->widget(CKEditor::class, [
                'options' => [
                    'preset' => 'full',
                ],
            ])->label('Описание') ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput()->label('SEO Заголовок') ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2])->label( 'SEO Описание') ?>
            <?= $form->field($model->meta, 'keywords')->textInput()->label('SEO Ключевые слова') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>