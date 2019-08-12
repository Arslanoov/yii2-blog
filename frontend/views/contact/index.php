<?php

/** @var $this yii\web\View */
/** @var $model blog\forms\ContactForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Contact';

?>

<div class="inner-banner">
    <div class="thm-container">
        <ul class="breadcumb">
            <li><a href="<?= Url::to(['/site/index']) ?>">Home</a></li><!--
        --><li><span class="sep">-</span></li><!--
        --><li><span class="page-name">Contact</span></li>
        </ul><!-- /.breadcumb -->
        <h3>Contact</h3>
    </div><!-- /.thm-container -->
</div><!-- /.inner-banner -->


<section class="contact-style-one">
    <div class="thm-container">
        <div class="row">
            <div class="col-md-7 col-sm-6 col-xs-12">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'contact-form'
                    ],
                ]) ?>

                    <?= $form->field($model, 'username')->textInput([
                        'id' => 'name',
                        'placeholder' => 'Your name',
                        'value' => (!Yii::$app->user->isGuest ? Yii::$app->user->identity->getUsername() : '')
                    ])->label(false) ?>

                    <?= $form->field($model, 'email')->textInput([
                        'id' => 'email',
                        'placeholder' => 'Your email address',
                        'value' => (!Yii::$app->user->isGuest ? Yii::$app->user->identity->getEmail() : '')
                    ])->label(false) ?>

                    <?= $form->field($model, 'message')->textarea([
                        'placeholder' => 'Write message here'
                    ])->label(false) ?>

                    <?= Html::submitButton('Send Message', [
                        'class' => 'button'
                    ]) ?>

                <?php ActiveForm::end() ?>

            </div><!-- /.col-md-7 -->
            <div class="col-md-5 col-sm-6 col-xs-12">
                <div class="contact-infos">
                    <div class="title">
                        <h3>You’ve any question? feel free to contact with us.</h3>
                    </div><!-- /.title -->
                    <div class="single-contact-info">
                        <h4>Call us for imiditate support on this number</h4>
                        <p>+ 8 800 555 35 35</p>
                    </div><!-- /.single-contact-info -->
                    <div class="single-contact-info">
                        <h4>Send us email for any kind of inquiry</h4>
                        <p>info@binmp.com</p>
                    </div><!-- /.single-contact-info -->
                </div><!-- /.contact-infos -->
            </div><!-- /.col-md-5 -->
        </div><!-- /.row -->
    </div><!-- /.thm-container -->
</section><!-- /.contact-style-one -->

<div
        class="google-map"
        id="contact-google-map"
        data-map-lat="40.712784"
        data-map-lng="-74.005941"
        data-icon-path="img/map-marker.png"
        data-map-title="Brooklyn, New York, United Kingdom"
        data-map-zoom="11"
        data-markers='{
        "marker-1": [40.712784, -74.005941, "<h4>Main Office</h4><p>Babylon Branch , Lindenhurst, UK</p>"],
        "marker-2": [40.728157, -74.077642, "<h4>Branch Office</h4> <p>291 Park Ave S, East Meadow, UK</p>"]
    }'>

</div>