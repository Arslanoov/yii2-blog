<?php

use yii\helpers\ReplaceArrayValue;

return [
    'id' => 'app-frontend-tests',
    'controllerNamespace' => 'frontend\controllers',
    'basePath' => dirname(__DIR__),
    'vendorPath' => __DIR__ . '/../../vendor',
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset'
    ],
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'j77vhdFUYZvqzahKtdzTOaQAnH8JuM6U',
        ],
        'user' => [
            'identityClass' => 'common\auth\Identity',
        ],
        'urlManager' => require (__DIR__ . '/urlManager.php'),
    ],
];
