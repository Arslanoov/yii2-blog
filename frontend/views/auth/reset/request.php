<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model blog\forms\auth\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Password Recovery';

?>

<section class="section">
    <div class="thm-container">
        <div class="row">
            <div class="text-center">
                <div class="col-sm-12">

                    <h1>Password Recovery</h1>

                    <p>Please enter your E-mail. We will send your account recovery data to this email</p>

                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'contact-form'
                        ],
                    ]); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <?= Html::submitButton('Send', ['class' => 'button']) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
