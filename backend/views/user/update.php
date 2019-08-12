<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\User\UserEditForm */
/* @var $user blog\entities\User\User */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

$this->title = 'Обновление пользователя №' . $user->id;

$this->params['breadcrumbs'][] = [
    'label' => 'Пользователи',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновить';

?>

<div class="user-update">

    <h1>Обновление пользователя</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true])->label('Имя пользователя') ?>
    <?= $form->field($model, 'aboutMe')->textarea(['rows' => '8'])->label('Обо мне') ?>
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
