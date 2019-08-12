<?php

namespace blog\helpers;

use blog\readModels\PageReadRepository;

/**
 * Class PageHelper
 * @package blog\helpers
 */
class PageHelper
{
    /** @var PageReadRepository */
    private $repository;

    /**
     * PageHelper constructor.
     * @param PageReadRepository $repository
     */
    public function __construct(PageReadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getPages(): array
    {
        return $this->repository->getAll();
    }
}