<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\User\UserEditForm */
/* @var $user blog\entities\User\User */

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

$this->title = 'Cabinet | Edit Photo';

?>

<section class="section">
    <div class="thm-container">
        <div class="row">
            <div class="text-center">
                <div class="col-sm-12">

                    <h1>Edit Photo</h1>

                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'contact-form',
                        ],
                    ]); ?>

                        <?= $form->field($model, 'photo')->widget(FileInput::class, [
                            'options' => [
                                'accept' => 'image/*',
                            ],
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Change', ['class' => 'button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>