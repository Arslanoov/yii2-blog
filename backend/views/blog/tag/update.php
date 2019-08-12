<?php

/** @var $this yii\web\View */
/** @var $model blog\forms\manage\Blog\TagForm */

$this->title = 'Обновление метки';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Метки',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновление метки';

?>

<div class="tag-update">

    <h1>Обновление метки</h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>