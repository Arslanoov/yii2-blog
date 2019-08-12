<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\PageForm */

$this->title = 'Обновить страницу';

$this->params['breadcrumbs'][] = 'Контент';
$this->params['breadcrumbs'][] = [
    'label' => 'Страницы',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновление страницы';

?>

<div class="page-update">

    <h1>Обновление страницы</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>