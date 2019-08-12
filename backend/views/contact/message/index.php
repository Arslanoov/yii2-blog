<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Contact\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';

$this->params['breadcrumbs'][] = 'Сообщения';

?>

<div class="message-index">

    <h1>Сообщения</h1>

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
                        'attribute' => 'date',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date_from',
                            'attribute2' => 'date_to',
                            'type' => DatePicker::TYPE_RANGE,
                            'separator' => '-',
                            'pluginOptions' => [
                                'todayHighlight' => true,
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                            ],
                        ]),
                        'format' => 'datetime',
                        'label' => 'Дата'
                    ],
                    [
                        'attribute' => 'username',
                        'label' => 'Имя пользователя'
                    ],
                    [
                        'attribute' => 'email',
                        'label' => 'E-mail'
                    ],
                    [
                        'class' => ActionColumn::class,
                        'buttons' => [
                            'update' => function ($model, $key, $index) {
                                return false;
                            }
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>