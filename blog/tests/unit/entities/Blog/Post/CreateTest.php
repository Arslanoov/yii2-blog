<?php

namespace blog\tests\unit\Blog\Post;

use blog\entities\Blog\Post\Post;
use blog\entities\Meta;
use Codeception\Test\Unit;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $post = Post::create(
            $authorId = 6,
            $categoryId = 2,
            $title = 'title',
            $slug = 'slug',
            $description = 'desc',
            $content = 'content',
            $meta = new Meta('Title', 'Desc', 'Keywords')
        );

        $this->assertEquals($post->author_id, $authorId);
        $this->assertEquals($post->category_id, $categoryId);
        $this->assertEquals($post->title, $title);
        $this->assertEquals($post->slug, $slug);
        $this->assertEquals($post->description, $description);
        $this->assertEquals($post->content, $content);
        $this->assertEquals($post->meta, $meta);
        $this->assertEquals($post->comments_count, 0);
        $this->assertNotEmpty($post->created_at);
        $this->assertTrue($post->isDraft());
        $this->assertFalse($post->isActive());
    }
}