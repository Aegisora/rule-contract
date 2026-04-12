<?php

namespace Aegisora\RuleContract\tests\unit\Models;

use Aegisora\RuleContract\Models\Context;
use PHPUnit\Framework\TestCase;

class ContextTest extends TestCase
{
    /**
     * @dataProvider getContextProvidedData
     */
    public function testCreate(
        array $actual,
        array $expected
    ): void {
        self::assertContextDataEqualsExpected(Context::create(...array_values($actual)), $expected);
    }

    /**
     * @dataProvider getContextProvidedData
     */
    public function testNewCreate(
        array $actual,
        array $expected
    ): void {
        self::assertContextDataEqualsExpected(new Context(...array_values($actual)), $expected);
    }

    public static function getContextProvidedData(): array
    {
        return [
            'value - not empty string' => [
                'actual' => [
                    'value' => 'foo',
                ],
                'expected' => [
                    'value' => 'foo',
                ],
            ],
        ];
    }

    private static function assertContextDataEqualsExpected(
        Context $actual,
        array $expected
    ): void {
        self::assertEquals($expected['value'], $actual->getValue());
    }
}
