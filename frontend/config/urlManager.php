<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'site/index',
        '<_a:about|faq>' => 'site/<_a>',

        'blog/all/page-<page:\d+>' => 'blog/post/index',
        'blog/all' => 'blog/post/index',

        'blog/popular/page-<page:\d+>' => 'blog/post/popular',
        'blog/popular' => 'blog/post/popular',

        'blog/best/page-<page:\d+>' => 'blog/post/likest',
        'blog/best' => 'blog/post/likest',

        'blog/tag/<slug:[\w\-]+>/page-<page:\d+>' => 'blog/post/tag',
        'blog/tag/<slug:[\w\-]+>' => 'blog/post/tag',

        'blog/search' => 'blog/post/search',

        'user/<_a:login|logout>' => 'auth/auth/<_a>',
        'user/signup' => 'auth/signup/request',
        'user/signup/confirm' => 'auth/signup/confirm',
        'user/reset/password' => 'auth/reset/request',
        'user/reset/password/confirm' => 'auth/reset/confirm',

        'blog/category/<slug:[\w\-]+>/page-<page:\d+>' => 'blog/post/category',
        'blog/category/<slug:[\w\-]+>' => 'blog/post/category',

        'blog/<id:\d+>-<slug:[\w\-]+>' => 'blog/post/single',
        'blog/<id:\d+>/comment' => 'blog/post/comment',

        'cabinet' => 'cabinet/default/index',
        'cabinet/edit' => 'cabinet/profile/edit',
        'cabinet/edit-photo' => 'cabinet/profile/edit-photo',
        'user/self' => 'cabinet/default/index',
        'user/<id:\d+>' => 'cabinet/default/view',

        'cabinet/<_c:[\w\-]+>' => 'cabinet/<_c>/index',
        'cabinet/<_c:[\w\-]+>/<id:\d+>' => 'cabinet/<_c>/view',
        'cabinet/<_c:[\w\-]+>/<_a:[\w-]+>' => 'cabinet/<_c>/<_a>',
        'cabinet/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => 'cabinet/<_c>/<_a>',

        ['pattern' => 'sitemap', 'route' => 'sitemap/index', 'suffix' => '.xml'],
        ['pattern' => 'sitemap-<target:[a-z-]+>-<start:\d+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],
        ['pattern' => 'sitemap-<target:[a-z-]+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],

        ['class' => 'frontend\urls\PageUrlRule'],

        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
];