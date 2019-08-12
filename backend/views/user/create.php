<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\User\UserCreateForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

$this->title = 'Создание пользователя';

$this->params['breadcrumbs'][] = [
    'label' => 'Пользователи',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Создание пользователя';

?>

<div class="user-create">

    <h1>Создание пользователя</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true])->label('Имя пользователя') ?>
    <?= $form->field($model, 'email')->textInput(['maxLength' => true])->label('E-mail') ?>
    <?= $form->field($model, 'password')->passwordInput(['maxLength' => true])->label('Пароль') ?>
    <?= $form->field($model, 'role')->dropDownList($model->rolesList())->label('Роль') ?>

    <div class="box box-default">
        <div class="box-header with-border">Фотография</div>
        <div class="box-body">
            <?= $form->field($model, 'photo')->label(false)->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
