<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;

?>

<div class="error-404-page">
    <div class="thm-container">
        <div class="row">
            <div class="col-md-7 col-sm-6 col-xs-12">
                <h3><?= $name ?></h3>
                <a href="<?= Url::to(['/site/index']) ?>" class="error-btn">Back To Home</a>
            </div>
            <div class="col-md-5 col-sm-6 col-xs-12">
                <img src="/img/404-man.png" alt="">
            </div>
        </div>
    </div>
</div>