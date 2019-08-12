<?php

use blog\helpers\PostHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $post blog\entities\Blog\Post\Post */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = 'Просмотр публикации';

$this->params['breadcrumbs'][] = 'Блог';
$this->params['breadcrumbs'][] = [
    'label' => 'Публикации',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = 'Просмотр публикации';

?>

<div class="post-view">

    <h1>Просмотр публикации</h1>

    <p>
        <?php if ($post->isActive()): ?>
            <?= Html::a('Деактивировать', ['draft', 'id' => $post->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Активировать', ['activate', 'id' => $post->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Обновить', ['update', 'id' => $post->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $post->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту публикацию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $post,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'status',
                        'label' => 'Статус',
                        'value' => PostHelper::statusLabel($post->status),
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок'
                    ],
                    [
                        'attribute' => 'category_id',
                        'label' => 'Категория',
                        'value' => ArrayHelper::getValue($post, 'category.name'),
                    ],
                    [
                        'label' => 'Метки',
                        'value' => implode(', ', ArrayHelper::getColumn($post->tags, 'name')),
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Фотография</div>
        <div class="box-body">
            <?php if ($post->photo): ?>
                <?= Html::a(Html::img($post->getThumbFileUrl('photo', 'thumb')), $post->getUploadedFileUrl('photo'), [
                    'class' => 'thumbnail',
                    'target' => '_blank'
                ]) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Описание</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asNtext($post->description) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Содержание</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asHtml($post->content, [
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
                'model' => $post,
                'attributes' => [
                    [
                        'attribute' => 'meta.title',
                        'label' => 'SEO Заголовок',
                        'value' => $post->meta->title,
                    ],
                    [
                        'attribute' => 'meta.description',
                        'label' => 'SEO Описание',
                        'value' => $post->meta->description,
                    ],
                    [
                        'attribute' => 'meta.keywords',
                        'label' => 'SEO Ключевые Слова',
                        'value' => $post->meta->keywords,
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>