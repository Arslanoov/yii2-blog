<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model blog\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

$this->title = 'Sign Up';

?>

<section class="section">
    <div class="thm-container">
        <div class="row">
            <div class="text-center">
                <div class="col-sm-12">
                    <h1>Sign Up</h1>

                    <p>Please enter your registration information</p>

                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'contact-form'
                        ],
                    ]); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'aboutMe')->textarea(['rows' => '8']) ?>

                        <?= Html::submitButton('Sign Up', [
                            'class' => 'button'
                        ]) ?>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</section>