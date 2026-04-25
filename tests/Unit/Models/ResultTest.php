<?php

namespace Aegisora\RuleContract\tests\Unit\Models;

use Aegisora\RuleContract\Models\Result;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    /**
     * @dataProvider getResultProvidedData
     */
    public function testCreateNew(
        array $actual,
        array $expected
    ): void {
        self::assertResultDataEqualsExpected(new Result(...array_values($actual)), $expected);
    }

    public static function getResultProvidedData(): array
    {
        return [
            'is valid - true, failed rule code - null' => [
                'actual' => [
                    'isValid' => true,
                    'failedRuleCode' => null,
                ],
                'expected' => [
                    'isValid' => true,
                    'failedRuleCode' => null,
                ],
            ],
            'is valid - false, failed rule code - null' => [
                'actual' => [
                    'isValid' => false,
                    'failedRuleCode' => null,
                ],
                'expected' => [
                    'isValid' => false,
                    'failedRuleCode' => null,
                ],
            ],
            'is valid - false, failed rule code - not empty string' => [
                'actual' => [
                    'isValid' => false,
                    'failedRuleCode' => 'foo',
                ],
                'expected' => [
                    'isValid' => false,
                    'failedRuleCode' => 'foo',
                ],
            ],
            'is valid - false, failed rule code - empty string' => [
                'actual' => [
                    'isValid' => false,
                    'failedRuleCode' => '',
                ],
                'expected' => [
                    'isValid' => false,
                    'failedRuleCode' => '',
                ],
            ],
        ];
    }

    private static function assertResultDataEqualsExpected(
        Result $actual,
        array $expected
    ): void {
        self::assertEquals($expected['isValid'], $actual->isValid());
        self::assertEquals($expected['failedRuleCode'], $actual->getFailedRuleCode());
    }
}
