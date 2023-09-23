<?php

namespace Cancio\Ds\Tests\Stack;

use Cancio\Ds\Stack\Stack;
use PHPUnit\Framework\TestCase;
use UnderflowException;

class StackTest extends TestCase
{

    public function testConstructorWhenEmpty(): void
    {
        $stack = new Stack();

        $this->assertSame([], $stack->toArray());
    }

    public function testConstructor(): void
    {
        $elements = ['A', 'B', 'C'];

        $stack = new Stack($elements);

        $this->assertSame($elements, $stack->toArray());
    }

    public function testClear(): void
    {
        $stack = new Stack();

        // Initial state
        $this->assertTrue($stack->isEmpty());

        // With elements
        $stack->push('A');
        $stack->push('B');
        $stack->push('C');
        $this->assertFalse($stack->isEmpty());

        $stack->clear();

        // After clear
        $this->assertTrue($stack->isEmpty());
    }

    public function testCopy(): void
    {
        $stack = new Stack();

        // Initial state
        $emptyStackCopy = $stack->copy();
        $this->assertSame([], $emptyStackCopy->toArray());
        $this->assertNotSame($emptyStackCopy, $stack);

        // With elements
        $stack->push('A');
        $stack->push('B');
        $stack->push('C');
        $stackCopy = $stack->copy();
        $this->assertSame(['A', 'B', 'C'], $stackCopy->toArray());
        $this->assertNotSame($stackCopy, $stack);
    }

    public function testCount(): void
    {
        $stack = new Stack();

        // Initial state
        $this->assertCount(0, $stack);

        // With elements
        $stack->push('A');
        $stack->push('B');
        $stack->push('C');
        $this->assertCount(3, $stack);
    }

    public function testGetIterator(): void
    {
        $elements = ['A', 'B', 'C'];

        $stack = new Stack($elements);

        $i = 2;

        foreach ($stack as $element) {
            $this->assertSame($element, $elements[$i--]);
        }

        $this->assertCount(0, $stack);
    }

    public function testIsEmpty(): void
    {
        $stack = new Stack();

        // Initial state
        $this->assertTrue($stack->isEmpty());

        // With elements
        $stack->push('A');
        $stack->push('B');
        $stack->push('C');
        $this->assertFalse($stack->isEmpty());
    }

    public function testPeekPopAndPush(): void
    {
        $stack = new Stack();

        // Adds A
        $stack->push('A');
        $this->assertSame('A', $stack->peek());
        $this->assertCount(1, $stack);

        // Adds B
        $stack->push('B');
        $this->assertSame('B', $stack->peek());
        $this->assertCount(2, $stack);

        // Adds C
        $stack->push('C');
        $this->assertSame('C', $stack->peek());
        $this->assertCount(3, $stack);

        // Removes A
        $this->assertSame('C', $stack->pop());
        $this->assertSame('B', $stack->peek());
        $this->assertCount(2, $stack);

        // Removes B
        $this->assertSame('B', $stack->pop());
        $this->assertSame('A', $stack->peek());
        $this->assertCount(1, $stack);

        // Removes C
        $this->assertSame('A', $stack->pop());
        $this->assertCount(0, $stack);
    }

    public function testPeekWhenStackIsEmpty(): void
    {
        $this->expectException(UnderflowException::class);

        $stack = new Stack();
        $stack->peek();
    }

    public function testPopWhenStackIsEmpty(): void
    {
        $this->expectException(UnderflowException::class);

        $stack = new Stack();
        $stack->pop();
    }

    public function testToArray(): void
    {
        $stack = new Stack();

        // Initial state
        $this->assertSame([], $stack->toArray());

        // With elements
        $stack->push('A');
        $stack->push('B');
        $stack->push('C');
        $this->assertSame(['A', 'B', 'C'], $stack->toArray());
    }

}