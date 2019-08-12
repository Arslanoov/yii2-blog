<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\TagForm */

$this->title = 'Создание метки';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Метки',
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = 'Создание метки';

?>

<div class="tag-create">

    <h1>Создание метки</h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
