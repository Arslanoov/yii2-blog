<?php

use dmstr\widgets\Menu;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Управление', 'options' => ['class' => 'header']],
                    ['label' => 'Главная', 'icon' => 'sitemap', 'url' => ['site/index'], 'visible' => Yii::$app->user->can('manager') | Yii::$app->user->can('moderator')],
                    ['label' => 'Пользователи', 'icon' => 'user', 'url' => ['user/index'], 'visible' => Yii::$app->user->can('admin')],
                    [
                        'label' => 'Блог',
                        'icon' => 'wordpress',
                        'items' => [
                            ['label' => 'Публикации', 'icon' => 'newspaper-o', 'url' => ['blog/post/index'], 'visible' => Yii::$app->user->can('content-manager')],
                            ['label' => 'Категории', 'icon' => 'reorder', 'url' => ['blog/category/index'], 'visible' => Yii::$app->user->can('content-manager')],
                            ['label' => 'Метки', 'icon' => 'tags', 'url' => ['blog/tag/index'], 'visible' => Yii::$app->user->can('content-manager')],
                            ['label' => 'Комментарии', 'icon' => 'commenting', 'url' => ['blog/comment/index'], 'visible' => Yii::$app->user->can('moderator')],
                        ],
                    ],
                    [
                        'label' => 'Контент',
                        'icon' => 'folder',
                        'items' => [
                            ['label' => 'Файлы', 'icon' => 'file-zip-o', 'url' => ['content/file/index']],
                            ['label' => 'Страницы', 'icon' => 'sticky-note-o', 'url' => ['content/page/index']],
                        ],
                        'visible' => Yii::$app->user->can('content-manager')
                    ],
                    ['label' => 'Сообщения', 'icon' => 'envelope-o', 'url' => ['contact/message/index'], 'visible' => Yii::$app->user->can('manager')],
                    ['label' => 'Меню разработчика', 'icon' => 'binoculars', 'url' => ['test/default/index'], 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Удалить кэш', 'icon' => 'trash', 'url' => ['cache/delete'], 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'На главную', 'icon' => 'sign-out', 'url' => 'http://blog.dev']
                ],
            ]
        ) ?>

    </section>

</aside>
