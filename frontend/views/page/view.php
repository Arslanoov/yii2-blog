<?php

/* @var $this yii\web\View */
/* @var $page blog\entities\Page */

use yii\helpers\Html;

$this->title = $page->getSeoTitle();
$this->registerMetaTag(['name' => 'description', 'content' => $page->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $page->meta->keywords]);

?>

<section class="section">
    <div class="thm-container">
        <div class="row">
            <div class="col-sm-12">
                <article class="padding-content">

                    <h1><?= Html::encode($page->title) ?></h1>

                    <?= Html::decode($page->content) ?>

                </article>
            </div>
        </div>
    </div>
</section>