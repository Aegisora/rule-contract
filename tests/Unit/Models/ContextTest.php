<?php

namespace Aegisora\RuleContract\Tests\Unit\Models;

use Aegisora\RuleContract\Models\Context;
use PHPUnit\Framework\TestCase;
use stdClass;

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

            'value - null' => [
                'actual' => [
                    'value' => null,
                ],
                'expected' => [
                    'value' => null,
                ],
            ],
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
            'value - integer negative' => [
                'actual' => [
                    'value' => -123,
                ],
                'expected' => [
                    'value' => -123,
                ],
            ],
            'value - float not zero' => [
                'actual' => [
                    'value' => 123.123,
                ],
                'expected' => [
                    'value' => 123.123,
                ],
            ],
            'value - float zero' => [
                'actual' => [
                    'value' => 0.0,
                ],
                'expected' => [
                    'value' => 0.0,
                ],
            ],
            'value - float negative' => [
                'actual' => [
                    'value' => -0.01,
                ],
                'expected' => [
                    'value' => -0.01,
                ],
            ],
            'value - boolean true' => [
                'actual' => [
                    'value' => true,
                ],
                'expected' => [
                    'value' => true,
                ],
            ],
            'value - boolean false' => [
                'actual' => [
                    'value' => false,
                ],
                'expected' => [
                    'value' => false,
                ],
            ],
            'value - not empty array' => [
                'actual' => [
                    'value' => ['foo', '', 0, 123, -123, null, 123.123, 0.0, -123.123, true, false, new stdClass(),],
                ],
                'expected' => [
                    'value' => ['foo', '', 0, 123, -123, null, 123.123, 0.0, -123.123, true, false, new stdClass(),],
                ],
            ],
            'value - empty array' => [
                'actual' => [
                    'value' => [],
                ],
                'expected' => [
                    'value' => [],
                ],
            ],
            'value - object' => [
                'actual' => [
                    'value' => new stdClass(),
                ],
                'expected' => [
                    'value' => new stdClass(),
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
