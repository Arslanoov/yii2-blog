<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var $this \yii\web\View */
/** @var $model \blog\forms\manage\Blog\TagForm */

$this->title = 'Просмотр метки';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Метки',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр метки';

?>

<div class="tag-view">

    <h1>Просмотр метки</h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'label' => 'Имя'
                    ],
                    [
                        'attribute' => 'slug',
                        'label' => 'Слаг'
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>