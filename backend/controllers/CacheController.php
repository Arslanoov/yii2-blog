<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class CacheController extends Controller
{
    public function behaviors(): array
    {
        return [
            [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionDelete()
    {
        Yii::$app->cache->flush();
        Yii::$app->session->setFlash('success', 'Кэш успешно очищен');
        return $this->goHome();
    }
}