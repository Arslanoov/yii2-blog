<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\PageForm */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'parentId')->dropDownList($model->parentsList())->label('Родительская страница') ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label('Слаг') ?>
            <?= $form->field($model, 'content')->widget(CKEditor::class, [
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'full'
                ]),
            ])->label('Содержание') ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput()->label('SEO Заголовок') ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2])->label('SEO Описание') ?>
            <?= $form->field($model->meta, 'keywords')->textInput()->label('SEO Ключевые Слова') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>