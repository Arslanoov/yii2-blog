<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\DataProviderInterface */
/** @var $q string */
/** @var $cloud array */

use yii\helpers\Html;
use yii\helpers\Url;
use blog\helpers\StringHelper;

$this->title = 'Blog | Search';

?>

<div class="inner-banner">
    <div class="thm-container">
        <ul class="breadcumb">
            <li><a href="<?= Url::to(['/site/index']) ?>">Home</a></li>
            <li><span class="sep">-</span></li>
            <li><span class="page-name">Blog</span></li>
        </ul>
        <h3>Search: <?= Html::encode(StringHelper::cut($q, 30, true)) ?></h3>
    </div>
</div>

<section class="blog-style-one">
    <div class="thm-container">
        <div class="row">
            <div class="col-sm-8">
                <?= $this->render('_list', [
                    'dataProvider' => $dataProvider
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?= $this->render('_sidebar', [
                    'cloud' => $cloud
                ]) ?>
            </div>
        </div>

    </div>
</section>