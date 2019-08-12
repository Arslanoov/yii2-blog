<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\DataProviderInterface */
/** @var $cloud array */

use yii\helpers\Url;

$this->title = 'Blog | All posts';

?>

<div class="inner-banner">
    <div class="thm-container">
        <ul class="breadcumb">
            <li><a href="<?= Url::to(['/site/index']) ?>">Home</a></li>
            <li><span class="sep">-</span></li>
            <li><span class="page-name">Blog</span></li>
        </ul>
        <h3>Blog Posts</h3>
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