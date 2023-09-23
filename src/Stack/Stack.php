<?php

namespace Cancio\Ds\Stack;

use Ds\Stack as BaseStack;
use Generator;

class Stack implements StackInterface
{

    private BaseStack $stack;

    public function __construct(array $elements = [])
    {
        $this->setStack($elements);
    }

    private function setStack(array $elements): void
    {
        $this->stack = new BaseStack();

        foreach ($elements as $element) {
            $this->push($element);
        }
    }

    public function clear(): StackInterface
    {
        $this->stack->clear();

        return $this;
    }

    public function copy(): StackInterface
    {
        return new self($this->toArray());
    }

    public function count(): int
    {
        return $this->stack->count();
    }

    public function getIterator(): Generator
    {
        while (!$this->isEmpty()) {
            yield $this->pop();
        }
    }

    public function isEmpty(): bool
    {
        return $this->stack->isEmpty();
    }

    public function peek()
    {
        return $this->stack->peek();
    }

    public function pop()
    {
        return $this->stack->pop();
    }

    public function push($element): StackInterface
    {
        $this->stack->push($element);

        return $this;
    }

    public function toArray(): array
    {
        return array_reverse($this->stack->toArray());
    }

}