<?php

namespace backend\controllers\content;

use yii\filters\AccessControl;
use yii\web\Controller;

class FileController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}