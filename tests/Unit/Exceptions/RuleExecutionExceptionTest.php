<?php

namespace Aegisora\RuleContract\Tests\Unit\Exceptions;

use Aegisora\RuleContract\Exceptions\RuleExecutionException;
use Exception;
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
        $previousException = new Exception();

        return [
            'rule class name - not empty, message - not empty, code - not zero, previous exception - set' => [
                'actualExceptionData' => [
                    'ruleClassName' => 'foo',
                    'message' => 'bar',
                    'code' => 1,
                    'previous' => $previousException,
                ],
                'expectedExceptionData' => [
                    'ruleClassName' => 'foo',
                    'message' => 'bar',
                    'code' => 1,
                    'previous' => $previousException,
                ],
            ],
            'rule class name - empty, message - empty, code - zero, previous exception - not set' => [
                'actualExceptionData' => [
                    'ruleClassName' => '',
                    'message' => '',
                    'code' => 0,
                    'previous' => null,
                ],
                'expectedExceptionData' => [
                    'ruleClassName' => '',
                    'message' => '',
                    'code' => 0,
                    'previous' => null,
                ],
            ],
        ];
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
