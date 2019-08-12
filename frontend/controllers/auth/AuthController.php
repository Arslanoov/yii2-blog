<?php

namespace frontend\controllers\auth;

use blog\forms\auth\LoginForm;
use blog\useCases\auth\AuthService;
use common\auth\Identity;
use yii\base\Module;
use yii\web\Controller;
use Yii;
use DomainException;

class AuthController extends Controller
{
    private $service;

    public function __construct(string $id, Module $module, AuthService $service, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->service->auth($form);
                Yii::$app->user->login(new Identity($user), $form->rememberMe ? Yii::$app->params['user.rememberMeDuration'] : 0);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Вы успешно авторизировались'));
                return $this->goHome();
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', Yii::t('app', 'Вы успешно вышли из системы'));
        return $this->goHome();
    }
}