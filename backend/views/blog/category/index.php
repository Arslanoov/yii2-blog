<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use blog\entities\Blog\Category;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Blog\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = 'Категории';

?>

<div class="category-index">

    <h1>Категории</h1>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?php Pjax::begin() ?>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'options' => ['class' => 'table-responsive'],
                'tableOptions' => ['class' => 'table table-condensed'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'value' => function (Category $model) {
                            $indent = ($model->depth > 1 ? str_repeat('&nbsp;&nbsp;', $model->depth - 1) . ' ' : '');
                            return $indent . Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'label' => 'Родительская Категория',
                        'format' => 'raw',
                    ],
                    [
                        'value' => function (Category $model) {
                            return
                                Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $model->id]) .
                                Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'text-align: center'],
                    ],
                    [
                        'attribute' => 'slug',
                        'label' => 'Слаг'
                    ],
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок'
                    ],

                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>

    <?php Pjax::end() ?>

</div>
