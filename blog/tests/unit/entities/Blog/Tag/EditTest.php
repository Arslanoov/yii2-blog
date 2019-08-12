<?php

namespace blog\tests\unit\entities\Blog\Tag;

use blog\entities\Blog\Tag;
use Codeception\Test\Unit;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $tag = Tag::create(
            $name = 'Name',
            $slug = 'slug'
        );

        $tag->edit(
            $newName = 'newName',
            $newSlug = 'newslug'
        );

        $this->assertEquals($tag->name, $newName);
        $this->assertEquals($tag->slug, $newSlug);
    }
}