<?php

use blog\helpers\UserHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model blog\entities\User\User */

$this->title = 'Просмотр пользователя №' . $model->id;

$this->params['breadcrumbs'][] = [
    'label' => 'Пользователи',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр пользователя';

?>

<div class="user-view">

    <h1>Просмотр пользователя</h1>

    <p>
        <?php if ($model->isBanned()): ?>
            <?= Html::a('Разбанить', ['unban', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Вы действтельно хотите разбанить этого пользователя?',
                    'method' => 'post',
                ]
            ])
        ?>
        <?php else: ?>
            <?= Html::a('Забанить', ['ban', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действтельно хотите забанить этого пользователя?',
                    'method' => 'post',
                ]
            ]) ?>

            <?php if ($model->isActive()): ?>
                <?= Html::a('Деактивировать', ['draft', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действтельно хотите деактивировать этого пользователя?',
                        'method' => 'post',
                    ]
                ])
                ?>
            <?php else: ?>
                <?= Html::a('Активировать', ['activate', 'id' => $model->id], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => 'Вы действтельно хотите активировать этого пользователя?',
                        'method' => 'post',
                    ]
                ]) ?>
            <?php endif; ?>
        <?php endif; ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действтельно хотите удалить этого пользователя?',
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
                        'attribute' => 'created_at',
                        'label' => 'Создан',
                        'format' => 'datetime'
                    ],
                    [
                        'attribute' => 'updated_at',
                        'label' => 'Обновлен',
                        'format' => 'datetime'
                    ],
                    [
                        'attribute' => 'username',
                        'label' => 'Имя пользователя',
                    ],
                    [
                        'attribute' => 'email',
                        'label' => 'E-mail',
                        'format' => 'email'
                    ],
                    [
                        'attribute' => 'about_me',
                        'label' => 'Обо мне'
                    ],
                    [
                        'attribute' => 'status',
                        'value' => UserHelper::statusLabel($model->status),
                        'format' => 'raw',
                        'label' => 'Статус'
                    ],
                    [
                        'label' => 'Роль',
                        'value' => implode(', ', ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($model->id), 'description')),
                        'format' => 'raw',
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Фотография</div>
        <div class="box-body">
            <?php if ($model->photo): ?>
                <?= Html::a(Html::img($model->getThumbFileUrl('photo', 'thumb')), $model->getUploadedFileUrl('photo'), [
                    'class' => 'thumbnail',
                    'target' => '_blank'
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
</div>
