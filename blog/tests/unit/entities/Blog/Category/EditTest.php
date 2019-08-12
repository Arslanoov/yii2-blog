<?php

namespace blog\tests\unit\entities\Blog\Category;

use blog\entities\Blog\Category;
use blog\entities\Meta;
use Codeception\Test\Unit;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $category = Category::create(
            $name = 'Name',
            $slug = 'slug',
            $title = 'title',
            $description = 'desc',
            $meta = new Meta('Title', 'Desc', 'Keywords')
        );

        $category->edit(
            $newName = 'newName',
            $newSlug = 'newslug',
            $newTitle = 'newTitle',
            $newDescription = 'newDesc',
            $newMeta = new Meta('newTitle', 'newDesc', 'newKeywords')
        );

        $this->assertEquals($category->name, $newName);
        $this->assertEquals($category->slug, $newSlug);
        $this->assertEquals($category->title, $newTitle);
        $this->assertEquals($category->description, $newDescription);
        $this->assertEquals($category->meta, $newMeta);
    }
}