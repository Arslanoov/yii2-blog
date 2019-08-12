<?php

namespace backend\controllers\blog;

use backend\forms\Blog\TagSearch;
use blog\entities\Blog\Tag;
use blog\forms\manage\Blog\TagForm;
use blog\useCases\manage\Blog\TagManageService;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use DomainException;

class TagController extends Controller
{
    private $service;

    public function __construct(string $id, Module $module, TagManageService $service, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST']
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['content-manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $form = new TagForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $tag = $this->service->create($form);
                Yii::$app->session->setFlash('success', 'Метка успешно создана');
                return $this->redirect(['view', 'id' => $tag->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $form
        ]);
    }

    public function actionUpdate($id)
    {
        $tag = $this->findModel($id);

        $form = new TagForm($tag);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($tag->id, $form);
                Yii::$app->session->setFlash('success', 'Метка успешно обновлена');
                return $this->redirect(['view', 'id' => $tag->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form
        ]);
    }

    public function actionDelete($id)
    {
        $this->service->delete($id);
        return $this->redirect(['blog/tag/index']);
    }

    private function findModel($id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundHttpException('Метка не найдена');
        }

        return $tag;
    }
}