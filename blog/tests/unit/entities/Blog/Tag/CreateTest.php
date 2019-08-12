<?php

namespace blog\tests\unit\entities\Blog\Tag;

use blog\entities\Blog\Tag;
use Codeception\Test\Unit;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $tag = Tag::create(
            $name = 'tagName',
            $slug = 'tagslug'
        );

        $this->assertEquals($tag->name, $name);
        $this->assertEquals($tag->slug, $slug);
    }
}