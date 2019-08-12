<?php

/** @var $this yii\web\View */
/** @var $categories array */

?>

<div class="single-sidebar categories-sidebar">
    <div class="title">
        <h3>Categories</h3>
    </div>

    <ul class="category-lists">
        <?php foreach ($categories as $category): ?>
            <?= $this->render('_category', ['item' => $category]) ?>
        <?php endforeach; ?>
    </ul>
</div>