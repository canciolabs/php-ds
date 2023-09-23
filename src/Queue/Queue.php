<?php

namespace Cancio\Ds\Queue;

use Ds\Deque as BaseDeque;
use Generator;

class Queue implements QueueInterface
{

    private BaseDeque $queue;

    public function __construct(array $elements = [])
    {
        $this->setQueue($elements);
    }

    private function setQueue(array $elements): void
    {
        $this->queue = new BaseDeque();

        foreach ($elements as $element) {
            $this->enqueue($element);
        }
    }

    public function clear(): QueueInterface
    {
        $this->queue->clear();

        return $this;
    }

    public function copy(): QueueInterface
    {
        return new self($this->queue->toArray());
    }

    public function count(): int
    {
        return $this->queue->count();
    }

    public function getIterator(): Generator
    {
        while (!$this->isEmpty()) {
            yield $this->dequeue();
        }
    }

    public function isEmpty(): bool
    {
        return $this->queue->isEmpty();
    }

    public function dequeue()
    {
        return $this->queue->shift();
    }

    public function enqueue($element): QueueInterface
    {
        $this->queue->push($element);

        return $this;
    }

    public function front()
    {
        return $this->queue->first();
    }

    public function rear()
    {
        return $this->queue->last();
    }

    public function toArray(): array
    {
        return $this->queue->toArray();
    }

}