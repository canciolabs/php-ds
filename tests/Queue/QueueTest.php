<?php

namespace Cancio\Ds\Tests\Queue;

use Cancio\Ds\Queue\Queue;
use PHPUnit\Framework\TestCase;
use UnderflowException;

class QueueTest extends TestCase
{

    public function testConstructorWhenEmpty(): void
    {
        $queue = new Queue();

        $this->assertSame([], $queue->toArray());
    }

    public function testConstructor(): void
    {
        $elements = ['A', 'B', 'C'];

        $queue = new Queue($elements);

        $this->assertSame($elements, $queue->toArray());
    }

    public function testClear(): void
    {
        $queue = new Queue();

        // Initial state
        $this->assertTrue($queue->isEmpty());

        // With elements
        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');
        $this->assertFalse($queue->isEmpty());

        $queue->clear();

        // After clear
        $this->assertTrue($queue->isEmpty());
    }

    public function testCopy(): void
    {
        $queue = new Queue();

        // Initial state
        $emptyQueueCopy = $queue->copy();
        $this->assertSame([], $emptyQueueCopy->toArray());
        $this->assertNotSame($emptyQueueCopy, $queue);

        // With elements
        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');
        $queueCopy = $queue->copy();
        $this->assertSame(['A', 'B', 'C'], $queueCopy->toArray());
        $this->assertNotSame($queueCopy, $queue);
    }

    public function testCount(): void
    {
        $queue = new Queue();

        // Initial state
        $this->assertCount(0, $queue);

        // With elements
        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');
        $this->assertCount(3, $queue);
    }

    public function testGetIterator(): void
    {
        $elements = ['A', 'B', 'C'];

        $queue = new Queue($elements);

        $i = 0;

        foreach ($queue as $element) {
            $this->assertSame($element, $elements[$i++]);
        }

        $this->assertCount(0, $queue);
    }

    public function testIsEmpty(): void
    {
        $queue = new Queue();

        // Initial state
        $this->assertTrue($queue->isEmpty());

        // With elements
        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');
        $this->assertFalse($queue->isEmpty());
    }

    public function testDequeueEnqueueFrontAndRear(): void
    {
        $queue = new Queue();

        // Adds A
        $queue->enqueue('A');
        $this->assertSame('A', $queue->front());
        $this->assertSame('A', $queue->rear());
        $this->assertCount(1, $queue);

        // Adds B
        $queue->enqueue('B');
        $this->assertSame('A', $queue->front());
        $this->assertSame('B', $queue->rear());
        $this->assertCount(2, $queue);

        // Adds C
        $queue->enqueue('C');
        $this->assertSame('A', $queue->front());
        $this->assertSame('C', $queue->rear());
        $this->assertCount(3, $queue);

        // Removes A
        $this->assertSame('A', $queue->dequeue());
        $this->assertSame('B', $queue->front());
        $this->assertSame('C', $queue->rear());
        $this->assertCount(2, $queue);

        // Removes B
        $this->assertSame('B', $queue->dequeue());
        $this->assertSame('C', $queue->front());
        $this->assertSame('C', $queue->rear());
        $this->assertCount(1, $queue);

        // Removes C
        $this->assertSame('C', $queue->dequeue());
        $this->assertCount(0, $queue);
    }

    public function testDequeueWhenQueueIsEmpty(): void
    {
        $this->expectException(UnderflowException::class);

        $queue = new Queue();
        $queue->dequeue();
    }

    public function testFrontWhenQueueIsEmpty(): void
    {
        $this->expectException(UnderflowException::class);

        $queue = new Queue();
        $queue->front();
    }

    public function testRearWhenQueueIsEmpty(): void
    {
        $this->expectException(UnderflowException::class);

        $queue = new Queue();
        $queue->rear();
    }

    public function testToArray(): void
    {
        $queue = new Queue();

        // Initial state
        $this->assertSame([], $queue->toArray());

        // With elements
        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');
        $this->assertSame(['A', 'B', 'C'], $queue->toArray());
    }

}