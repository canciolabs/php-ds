<?php

namespace Cancio\Ds\Stack;

use Countable;
use Generator;
use IteratorAggregate;

interface StackInterface extends Countable, IteratorAggregate
{

    /**
     * Removes all elements from the stack.
     * @return self
     */
    public function clear(): self;

    /**
     * Returns a copy of the stack.
     * @return self
     */
    public function copy(): self;

    /**
     * Returns the number of elements in the stack.
     * @return int
     */
    public function count(): int;

    /**
     * Returns an iterator.
     * @return Generator
     */
    public function getIterator(): Generator;

    /**
     * Checks if the stack is empty.
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Returns the top element of the stack.
     * @return mixed
     */
    public function peek();

    /**
     * Add an element to the stack.
     * @param mixed $element
     * @return $this
     */
    public function push($element): StackInterface;

    /**
     * Removes and return the top element of the stack.
     * @return mixed
     */
    public function pop();

    /**
     * Converts the stack to an array (bottom to top).
     * @return array
     */
    public function toArray(): array;

}