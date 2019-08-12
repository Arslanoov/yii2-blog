<?php

/* @var $this yii\web\View */
/* @var $model blog\forms\manage\Blog\Post\PostForm */

$this->title = 'Создание публикации';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Публикации',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Создание публикации';

?>

<div class="post-create">

    <h1>Создание публикации</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>