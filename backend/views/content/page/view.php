<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $page blog\entities\Page */

$this->title = Html::encode($page->title);

$this->params['breadcrumbs'][] = 'Контент';
$this->params['breadcrumbs'][] = [
    'label' => 'Страницы',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = Html::encode($page->title);

?>
<div class="page-view">

    <h1>Просмотр страницы</h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $page->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $page->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту страницу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $page,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок'
                    ],
                    [
                        'attribute' => 'slug',
                        'label' => 'Слаг'
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <?= Yii::$app->formatter->asHtml($page->content, [
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
                'model' => $page,
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