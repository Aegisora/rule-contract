<?php

namespace Aegisora\RuleContract\Tests\Unit\Models;

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
            'value - empty string' => [
                'actual' => [
                    'value' => '',
                ],
                'expected' => [
                    'value' => '',
                ],
            ],
            'value - integer not zero' => [
                'actual' => [
                    'value' => 123,
                ],
                'expected' => [
                    'value' => 123,
                ],
            ],
            'value - integer zero' => [
                'actual' => [
                    'value' => 0,
                ],
                'expected' => [
                    'value' => 0,
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
