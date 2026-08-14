<?php

namespace Aegisora\RuleContract\Tests\Unit\Models;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\RuleContext;
use Aegisora\RuleContract\Models\RuleContextCollection;
use Aegisora\RuleContract\Tests\Unit\DefaultValidResultTestRule;
use PHPUnit\Framework\TestCase;

class RuleContextCollectionTest extends TestCase
{
    public function testEmpty(): void
    {
        self::assertCollectionDataEqualsExpected(
            RuleContextCollection::create(),
            [
                'items' => [],
                'count' => 0,
                'isEmpty' => true,
            ]
        );
    }

    public function testNewEmpty(): void
    {
        self::assertCollectionDataEqualsExpected(
            new RuleContextCollection(),
            [
                'items' => [],
                'count' => 0,
                'isEmpty' => true,
            ]
        );
    }

    public function testWithItems(): void
    {
        $items = self::buildItems();

        self::assertCollectionDataEqualsExpected(
            RuleContextCollection::create(...$items),
            [
                'items' => $items,
                'count' => 2,
                'isEmpty' => false,
            ]
        );
    }

    public function testNewWithItems(): void
    {
        $items = self::buildItems();

        self::assertCollectionDataEqualsExpected(
            new RuleContextCollection(...$items),
            [
                'items' => $items,
                'count' => 2,
                'isEmpty' => false,
            ]
        );
    }

    public function testIsIterable(): void
    {
        $items = self::buildItems();
        $collection = new RuleContextCollection(...$items);

        $iterated = [];
        foreach ($collection as $key => $item) {
            $iterated[$key] = $item;
        }

        self::assertSame($items, $iterated);
        self::assertSame([0, 1], array_keys($iterated));
    }

    public function testIsReiterable(): void
    {
        $items = self::buildItems();
        $collection = new RuleContextCollection(...$items);

        self::assertSame($items, iterator_to_array($collection));
        self::assertSame($items, iterator_to_array($collection));
    }

    public function testIteratorProtocolOnItems(): void
    {
        $items = self::buildItems();
        $collection = new RuleContextCollection(...$items);

        $collection->rewind();
        self::assertTrue($collection->valid());
        self::assertSame(0, $collection->key());
        self::assertSame($items[0], $collection->current());

        $collection->next();
        self::assertTrue($collection->valid());
        self::assertSame(1, $collection->key());
        self::assertSame($items[1], $collection->current());

        $collection->next();
        self::assertFalse($collection->valid());
        self::assertSame(2, $collection->key());
    }

    public function testIteratorProtocolOnEmpty(): void
    {
        $collection = new RuleContextCollection();

        $collection->rewind();
        self::assertFalse($collection->valid());
        self::assertSame(0, $collection->key());
    }

    /**
     * @return array<int, RuleContext>
     */
    private static function buildItems(): array
    {
        return [
            new RuleContext(new DefaultValidResultTestRule(), Context::create('foo')),
            new RuleContext(new DefaultValidResultTestRule(), Context::create('bar')),
        ];
    }

    private static function assertCollectionDataEqualsExpected(
        RuleContextCollection $actual,
        array $expected
    ): void {
        self::assertSame($expected['items'], $actual->toArray());
        self::assertSame($expected['count'], $actual->count());
        self::assertSame($expected['isEmpty'], $actual->isEmpty());
    }
}
