<?php

namespace frontend\controllers\cabinet;

use blog\forms\User\ProfileEditDataForm;
use blog\forms\User\ProfileEditPhotoForm;
use blog\useCases\cabinet\ProfileService;
use blog\entities\User\User;
use yii\web\Controller;
use Yii;
use DomainException;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    private $service;

    public function __construct($id, $module, ProfileService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionEdit()
    {
        $user = $this->findModel(Yii::$app->user->id);

        $form = new ProfileEditDataForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($user->id, $form);
                return $this->redirect(['/cabinet/default/index']);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('edit', [
            'model' => $form,
        ]);
    }

    public function actionEditPhoto()
    {
        $form = new ProfileEditPhotoForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->editPhoto(Yii::$app->user->id, $form);
                return $this->redirect(['/cabinet/default/index']);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('edit-photo', [
            'model' => $form,
        ]);
    }

    public function actionDeletePhoto()
    {
        $this->service->nullPhoto(Yii::$app->user->id);
        return $this->redirect(['/cabinet/default/index']);
    }

    private function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('This page does not exist');
    }
}