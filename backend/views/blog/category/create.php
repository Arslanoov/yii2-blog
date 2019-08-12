<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\TagForm */

$this->title = 'Создание категории';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Категории',
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = 'Создание категории';

?>

<div class="category-create">

    <h1>Создание категории</h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
