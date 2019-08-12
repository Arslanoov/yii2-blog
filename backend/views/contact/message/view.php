<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model blog\entities\Contact\Message */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = 'Просмотр сообщения';

$this->params['breadcrumbs'][] = [
    'label' => 'Сообщения',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр сообщения';

?>

<div class="message-view">

    <h1>Просмотр сообщения</h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить это сообщения?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'date',
                        'label' => 'Дата'
                    ],
                    [
                        'attribute' => 'username',
                        'label' => 'Имя пользователя'
                    ],
                    [
                        'attribute' => 'email',
                        'label' => 'E-mail',
                        'format' => 'email'
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Содержание</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asNtext($model->message) ?>
        </div>
    </div>

</div>