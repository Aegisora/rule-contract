<?php

namespace Aegisora\RuleContract\tests\unit\Exceptions;

use Aegisora\RuleContract\Exceptions\RuleExecutionException;
use PHPUnit\Framework\TestCase;

class RuleExecutionExceptionTest extends TestCase
{
    private const TEST_VALUE_RULE_CLASS_NAME = 'rule_class_name';

    public function testDefaultCreate(): void
    {
        self::assertExceptionDataEqualsExpected(
            new RuleExecutionException(self::TEST_VALUE_RULE_CLASS_NAME),
            [
                'ruleClassName' => self::TEST_VALUE_RULE_CLASS_NAME,
                'message' => '',
                'code' => 0,
                'previous' => null,
            ],
        );
    }

    /**
     * @dataProvider getExceptionProvidedData
     */
    public function testCreate(
        array $actualExceptionData,
        array $expectedExceptionData
    ): void {
        self::assertExceptionDataEqualsExpected(
            new RuleExecutionException(...array_values($actualExceptionData)),
            $expectedExceptionData
        );
    }

    public static function getExceptionProvidedData(): array
    {
        return [];
    }

    private static function assertExceptionDataEqualsExpected(
        RuleExecutionException $actualException,
        array $expectedData
    ): void {
        self::assertEquals($expectedData['ruleClassName'], $actualException->getRuleClassName());
        self::assertEquals($expectedData['message'], $actualException->getMessage());
        self::assertEquals($expectedData['code'], $actualException->getCode());
        self::assertEquals($expectedData['previous'], $actualException->getPrevious());
    }
}
