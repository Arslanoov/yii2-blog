<?php

namespace blog\entities;

/**
 * Interface AggregateRoot
 * @package blog\entities
 */
interface AggregateRoot
{
    /** @return array */
    public function releaseEvents(): array;
}