<?php

use blog\entities\Blog\Post\Comment;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Blog\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = 'Комментарии';

?>

<div class="comment-index">

    <h1>Комментарии</h1>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'options' => ['class' => 'table-responsive'],
                'tableOptions' => ['class' => 'table table-condensed'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'created_at',
                        'label' => 'Создан',
                        'format' => 'datetime'
                    ],
                    [
                        'attribute' => 'text',
                        'value' => function (Comment $model) {
                            return StringHelper::truncate(strip_tags($model->text), 100);
                        },
                        'label' => 'Содержание'
                    ],
                    [
                        'attribute' => 'active',
                        'label' => 'Статус',
                        'filter' => $searchModel->activeList(),
                        'format' => 'boolean',
                    ],

                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>