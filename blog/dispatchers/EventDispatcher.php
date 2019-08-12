<?php

namespace blog\dispatchers;

/**
 * Interface EventDispatcher
 * @package blog\dispatchers
 */
interface EventDispatcher
{
    /** @param array $events */
    public function dispatchAll(array $events): void;

    /** @param $event */
    public function dispatch($event): void;
}