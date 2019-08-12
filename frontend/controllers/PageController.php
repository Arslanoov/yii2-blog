<?php

namespace frontend\controllers;

use blog\readModels\PageReadRepository;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{
    private $pages;

    public function __construct(string $id, Module $module, PageReadRepository $pages, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->pages = $pages;
    }

    public function actionView($id)
    {
        if (!$page = $this->pages->find($id)) {
            throw new NotFoundHttpException('Данной страницы не существует');
        }

        return $this->render('view', [
            'page' => $page,
        ]);
    }
}