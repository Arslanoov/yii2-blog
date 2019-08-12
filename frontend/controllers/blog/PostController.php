<?php

namespace frontend\controllers\blog;

use blog\forms\Blog\CommentForm;
use blog\helpers\StringHelper;
use blog\readModels\Blog\CategoryReadRepository;
use blog\readModels\Blog\PostReadRepository;
use blog\readModels\Blog\TagReadRepository;
use blog\useCases\Blog\CommentService;
use blog\useCases\manage\Blog\PostManageService;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
use DomainException;

class PostController extends Controller
{
    private $commentService;
    private $postService;
    private $posts;
    private $categories;
    private $tags;

    public function __construct(
        string $id,
        Module $module,
        CommentService $commentService,
        PostReadRepository $posts,
        PostManageService $postService,
        CategoryReadRepository $categories,
        TagReadRepository $tags,
        array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->commentService = $commentService;
        $this->postService = $postService;
        $this->posts = $posts;
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['comment', 'like'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?', '@']
                    ],
                ],
            ],/*
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['POST'],
                ],
            ]*/
        ];
    }

    public function actionIndex()
    {
        $dataProvider = $this->posts->getAll();

        $tags = $this->tags->getAll();
        $cloud = $this->tags->getCloud($tags);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'cloud' => $cloud
        ]);
    }

    public function actionSearch()
    {
        $q = Yii::$app->request->get('q');
        $dataProvider = $this->posts->getByQuery($q);

        $tags = $this->tags->getAll();
        $cloud = $this->tags->getCloud($tags);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'cloud' => $cloud,
            'q' => $q
        ]);
    }

    public function actionPopular()
    {
        $dataProvider = $this->posts->getPopular();

        $tags = $this->tags->getAll();
        $cloud = $this->tags->getCloud($tags);

        return $this->render('popular', [
            'dataProvider' => $dataProvider,
            'cloud' => $cloud
        ]);
    }

    public function actionLikest()
    {
        $dataProvider = $this->posts->getLikest();

        $tags = $this->tags->getAll();
        $cloud = $this->tags->getCloud($tags);

        return $this->render('likest', [
            'dataProvider' => $dataProvider,
            'cloud' => $cloud
        ]);
    }

    public function actionCategory($slug)
    {
        if (!$category = $this->categories->findBySlug($slug)) {
            throw new NotFoundHttpException('Страница не найдена');
        }
        $dataProvider = $this->posts->getAllByCategory($category);

        $tags = $this->tags->getAll();
        $cloud = $this->tags->getCloud($tags);

        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider,
            'cloud' => $cloud
        ]);
    }

    public function actionTag($slug)
    {
        if (!$tag = $this->tags->findBySlug($slug)) {
            throw new NotFoundHttpException('Метки не существует');
        }
        $dataProvider = $this->posts->getAllByTag($tag);

        $tags = $this->tags->getAll();
        $cloud = $this->tags->getCloud($tags);

        return $this->render('tag', [
            'tag' => $tag,
            'dataProvider' => $dataProvider,
            'cloud' => $cloud
        ]);
    }

    public function actionSingle($id, $slug)
    {
        if (!$post = $this->posts->find($id)) {
            throw new NotFoundHttpException('Post is not found');
        }
        if (!$this->posts->findBySlug($id, $slug)) {
            return $this->redirect(['/blog/post/single', 'id' => $id, 'slug' => $post->slug]);
        }

        $tags = $this->tags->getAll();
        $cloud = $this->tags->getCloud($tags);

        return $this->render('single', [
            'post' => $post,
            'cloud' => $cloud
        ]);
    }

    public function actionComment($id)
    {
        if (!$post = $this->posts->find($id)) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        $form = new CommentForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $comment = $this->commentService->create($post->id, Yii::$app->user->id, $form);
                return $this->redirect(['/blog/post/single', 'id' => $post->id, 'slug' => $post->slug, '#' => 'comment_' . $comment->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('comment', [
            'post' => $post,
            'model' => $form,
        ]);
    }

    public function actionLike()
    {
        if (Yii::$app->request->isAjax) {
            $postId = Yii::$app->request->get('postId');
            $likes = $this->postService->like(Yii::$app->user->id, $postId);
            return $likes;
        }
    }
}