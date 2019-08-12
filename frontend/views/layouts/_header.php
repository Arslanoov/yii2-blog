<?php

/** @var $pageHelper \blog\helpers\PageHelper */

use yii\widgets\Menu;
use yii\helpers\Url;

?>

<header class="header header-home-one">
    <nav class="navbar navbar-default header-navigation stricky">
        <div class="thm-container clearfix">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".main-navigation" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?= Url::to(['/site/index']) ?>">
                    <img src="/img/logo-1-1.png" alt="">
                </a>
            </div>

            <div class="collapse navbar-collapse main-navigation mainmenu " id="main-nav-bar">

                <?php $menu = [
                    'options' => [
                        'class' => 'nav navbar-nav navigation-box'
                    ],
                    'activeCssClass' => 'current',
                    'submenuTemplate' => "<ul class=\"sub-menu\">{items}</ul>",
                ];

                $menu['items'][] = ['label' => 'Home', 'url' => ['/site/index']];

                $menu['items']['pages'] = [
                    'label' => 'Pages',
                    'url' => '#',
                    'items' => [
                        ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'FAQ', 'url' => ['/site/faq']],
                        ['label' => 'Contact', 'url' => ['/contact/index']],
                    ]
                ];

                $pages = $pageHelper->getPages();
                foreach ($pages as $page) {
                    $item = [
                        'label' => $page->title,
                        'url' => ['/page/view', 'id' => $page->id],
                    ];

                    $menu['items']['pages']['items'][] = $item;
                }

                $menu['items'][] = [
                    'label' => 'Blog',
                    'url' => ['/blog/post/index'],
                    'items' => [
                        ['label' => 'All', 'url' => ['/blog/post/index']],
                        ['label' => 'Popular', 'url' => ['/blog/post/popular']],
                        ['label' => 'Best', 'url' => ['/blog/post/likest']]
                    ]
                ];

                $menu['items'][] = [
                    'label' => 'User',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Login', 'url' => ['/auth/auth/login'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'Sign Up', 'url' => ['/auth/signup/request'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'Cabinet', 'url' => ['/cabinet/default/index'], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => 'Logout', 'url' => ['/auth/auth/logout'], 'visible' => !Yii::$app->user->isGuest]
                    ]
                ];

                $menu['items'][] = ['label' => 'Manage', 'url' => 'http://admin.blog.dev', 'visible' => Yii::$app->user->can('manager') || Yii::$app->user->can('moderator')];

                ?>

                <?= Menu::widget($menu) ?>

            </div>
        </div>
    </nav>
</header>