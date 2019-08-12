<?php

namespace blog\entities;

/**
 * Trait EventTrait
 * @package blog\entities
 */
trait EventTrait
{
    /** @var array */
    private $events = [];

    /**
     * @param $event
     */
    protected function recordEvent($event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return array
     */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}