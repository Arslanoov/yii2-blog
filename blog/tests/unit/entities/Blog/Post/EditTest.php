<?php

namespace blog\tests\unit\Blog\Post;

use blog\entities\Blog\Post\Post;
use blog\entities\Meta;
use Codeception\Test\Unit;

class EditTest extends Unit
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

        $post->edit(
            $newCategoryId = 4,
            $newTitle = 'newTitle',
            $newSlug = 'newslug',
            $newDescription = 'newDesc',
            $newContent = 'newContent',
            $newMeta = new Meta('Title', 'Desc', 'Keywords')
        );

        $this->assertEquals($post->category_id, $newCategoryId);
        $this->assertEquals($post->title, $newTitle);
        $this->assertEquals($post->slug, $newSlug);
        $this->assertEquals($post->description, $newDescription);
        $this->assertEquals($post->content, $newContent);
        $this->assertEquals($post->meta, $newMeta);
    }
}