<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $post blog\entities\Blog\Post\Post */
/* @var $comment blog\entities\Blog\Post\Comment */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = 'Просмотр комментария';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Комментарии',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр комментария';

?>

<div class="comment-view">

    <h1>Просмотр комментария</h1>

    <p>
        <?= Html::a('Обновить', ['update', 'post_id' => $post->id, 'id' => $comment->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($comment->isActive()): ?>
            <?= Html::a('Удалить', ['delete', 'post_id' => $post->id, 'id' => $comment->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить этот комментарий?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Восстановить', ['activate', 'post_id' => $post->id, 'id' => $comment->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Вы действительно хотите восстановить этот комментарий?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $comment,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'parent_id',
                        'label' => 'Родительский Комментарий'
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Создан',
                        'format' => 'boolean'
                    ],
                    [
                        'attribute' => 'user.name',
                        'label' => 'Имя автора',
                        'value' => function ($data) {
                            return $data->author->username;
                        }
                    ],
                    [
                        'attribute' => 'post_id',
                        'label' => 'Заголовок публикации',
                        'value' => $post->title,
                    ],
                    [
                        'attribute' => 'active',
                        'label' => 'Активный',
                        'format' => 'boolean'
                    ]
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <?= Yii::$app->formatter->asNtext($comment->text) ?>
        </div>
    </div>

</div>