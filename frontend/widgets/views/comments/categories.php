<?php

/** @var $this yii\web\View */
/** @var $categories array */

?>

<ul id="options" class="clearfix extra-padding-top">
    <?php foreach ($categories as $category): ?>
        <?= $this->render('_category', ['item' => $category]) ?>
    <?php endforeach; ?>
</ul>