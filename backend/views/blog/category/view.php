<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var $this \yii\web\View */
/** @var $model \blog\forms\manage\Blog\TagForm */

$this->title = 'Просмотр категории';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Категории',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр категории';

?>

<div class="category-view">

    <h1>Просмотр категории</h1>

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
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок'
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Описание</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asHtml($model->description, [
                'Attr.AllowedRel' => array('nofollow'),
                'HTML.SafeObject' => true,
                'Output.FlashCompat' => true,
                'HTML.SafeIframe' => true,
                'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'meta.title',
                        'label' => 'SEO Заголовок'
                    ],
                    [
                        'attribute' => 'meta.description',
                        'label' => 'SEO Описание'
                    ],
                    [
                        'attribute' => 'meta.keywords',
                        'label' => 'SEO Ключевые Слова'
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>