<?php

namespace blog\dispatchers;

/**
 * Class DeferredEventDispatcher
 * @package blog\dispatchers
 */
class DeferredEventDispatcher implements EventDispatcher
{
    /** @var bool */
    private $defer = false;
    /** @var array */
    private $queue = [];
    /** @var EventDispatcher */
    private $next;

    /**
     * DeferredEventDispatcher constructor.
     * @param EventDispatcher $next
     */
    public function __construct(EventDispatcher $next)
    {
        $this->next = $next;
    }

    /**
     * @param array $events
     */
    public function dispatchAll(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch($event);
        }
    }

    /**
     * @param $event
     */
    public function dispatch($event): void
    {
        if ($this->defer) {
            $this->queue[] = $event;
        } else {
            $this->next->dispatch($event);
        }
    }

    /**
     * @return void
     */
    public function defer(): void
    {
        $this->defer = true;
    }

    /**
     * @return void
     */
    public function clean(): void
    {
        $this->queue = [];
        $this->defer = false;
    }

    /**
     * @return void
     */
    public function release(): void
    {
        foreach ($this->queue as $i => $event) {
            $this->next->dispatch($event);
            unset($this->queue[$i]);
        }

        $this->defer = false;
    }
}