<?php

namespace console\controllers;

use blog\entities\User\User;
use blog\useCases\manage\User\UserManageService;
use Yii;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\ArrayHelper;

class RoleController extends Controller
{
    private $service;

    public function __construct($id, $module, UserManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionAssign(): void
    {
        $username = $this->prompt('Имя пользователя:', ['required' => true]);
        $user = $this->findModel($username);
        $role = $this->select('Роль:', ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'));
        $this->service->assignRole($user->id, $role);
        $this->stdout('Сделано!' . PHP_EOL);
    }

    private function findModel($username): User
    {
        if (!$model = User::findOne(['username' => $username])) {
            throw new Exception('Пользователь не найден');
        }
        return $model;
    }
}