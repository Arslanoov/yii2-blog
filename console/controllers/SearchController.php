<?php

namespace console\controllers;

use blog\entities\Blog\Post\Post;
use blog\services\search\PostIndexer;
use yii\console\Controller;

class SearchController extends Controller
{
    private $indexer;

    public function __construct($id, $module, PostIndexer $indexer, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->indexer = $indexer;
    }

    public function actionReindex(): void
    {
        $query = Post::find()
            ->active()
            ->with(['tagAssignments'])
            ->orderBy('id');

        $this->stdout('Clearing' . PHP_EOL);
        $this->indexer->clear();
        $this->stdout('Indexing of posts' . PHP_EOL);

        foreach ($query->each() as $post) {
            $this->stdout('Post #' . $post->id . PHP_EOL);
            $this->indexer->index($post);
        }

        $this->stdout('Done!' . PHP_EOL);
    }
}