<?php

namespace blog\services\search;

use blog\entities\Blog\Post\Post;
use Elasticsearch\Client;
use yii\helpers\ArrayHelper;

class PostIndexer
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function clear(): void
    {
        $this->client->deleteByQuery([
            'index' => 'blog',
            'type' => 'posts',
            'body' => [
                'query' => [
                    'match_all' => new \stdClass(),
                ],
            ],
        ]);
    }
    public function index(Post $post): void
    {
        $this->client->index([
            'index' => 'blog',
            'type' => 'posts',
            'id' => $post->id,
            'body' => [
                'id' => $post->id,
                'title',
                'slug',
                'description' => strip_tags($post->description),
                'content' => strip_tags($post->description),
                'tags' => ArrayHelper::getColumn($post->tagAssignments, 'tag_id'),
            ],
        ]);
    }
    
    public function remove(Post $post): void
    {
        $this->client->delete([
            'index' => 'post',
            'type' => 'posts',
            'id' => $post->id,
        ]);
    }
}