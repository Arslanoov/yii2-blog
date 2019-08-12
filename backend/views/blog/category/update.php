<?php

/** @var $this yii\web\View */
/** @var $model blog\forms\manage\Blog\TagForm */

$this->title = 'Обновление категории';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Категории',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновление категории';

?>

<div class="category-update">

    <h1>Обновление категории</h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>