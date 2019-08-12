<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\Post\PostForm */

$this->title = 'Обновление публикации';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Публикации',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Обновление публикации';

?>

<div class="post-update">

    <h1>Обновление публикации</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>