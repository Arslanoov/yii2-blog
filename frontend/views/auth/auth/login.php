<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \blog\entities\User\User */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';

?>

<section class="section">
    <div class="thm-container">
        <div class="row">
            <div class="text-center">
                <div class="col-sm-12">
                    <h1>Login</h1>

                    <p>Enter your account information to login</p>

                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'contact-form'
                        ],
                    ]); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <p>
                            <a href="<?= Url::to(['/auth/reset/request']) ?>">If you forget your password you can reset it</a>
                        </p>

                        <?= Html::submitButton('Login', [
                            'class' => 'button'
                        ]) ?>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</section>