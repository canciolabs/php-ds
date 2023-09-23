<?php

namespace Cancio\Ds\Queue;

use Countable;
use Generator;
use IteratorAggregate;

interface QueueInterface extends Countable, IteratorAggregate
{

    /**
     * Removes all elements from the queue.
     * @return self
     */
    public function clear(): self;

    /**
     * Returns a copy of the queue.
     * @return self
     */
    public function copy(): self;

    /**
     * Returns the number of elements in the queue.
     * @return int
     */
    public function count(): int;

    /**
     * Returns an iterator.
     * @return Generator
     */
    public function getIterator(): Generator;

    /**
     * Checks if the queue is empty.
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Add an element to the queue.
     * @param mixed $element
     * @return $this
     */
    public function enqueue($element): QueueInterface;

    /**
     * Removes and return the front element element of the queue.
     * @return mixed
     */
    public function dequeue();

    /**
     * Returns the front element of the queue.
     * @return mixed
     */
    public function front();

    /**
     * Returns the rear element of the queue.
     * @return mixed
     */
    public function rear();

    /**
     * Converts the queue to an array (front to rear).
     * @return array
     */
    public function toArray(): array;

}