<?php

namespace frontend\controllers\cabinet;

use Yii;
use blog\entities\User\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function behaviors(): array
    {
        return [
            [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = $this->findModel(Yii::$app->user->id);

        return $this->render('index', [
            'user' => $user
        ]);
    }

    public function actionView($id)
    {
        $user = $this->findModel($id);

        return $this->render('view', [
            'user' => $user
        ]);
    }

    private function findModel($id): ?User
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Пользователь не найден');
    }
}