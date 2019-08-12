<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\PageForm */

$this->title = 'Создать страницу';

$this->params['breadcrumbs'][] = 'Контент';
$this->params['breadcrumbs'][] = [
    'label' => 'Страницы',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Создание страницы';

?>

<div class="page-create">

    <h1>Создание страницы</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>