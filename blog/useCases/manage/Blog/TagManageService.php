<?php

namespace blog\useCases\manage\Blog;

use blog\entities\Blog\Tag;
use blog\forms\manage\Blog\TagForm;
use blog\repositories\Blog\TagRepository;

class TagManageService
{
    private $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    public function create(TagForm $form): Tag
    {
        $tag = Tag::create(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
        return $tag;
    }

    public function edit($id, TagForm $form): void
    {
        $tag = $this->tags->get($id);
        $tag->edit(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
    }

    public function delete($id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }
}