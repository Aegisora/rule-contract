<?php

namespace Aegisora\RuleContract\Tests\Unit;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;
use Aegisora\RuleContract\Exceptions\RuleExecutionException;
use Aegisora\RuleContract\Models\Context;
use Exception;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    public function testInvalidRuleContextException(): void
    {
        $rule = new InvalidRuleContextExceptionTestRule();

        $this->expectException(InvalidRuleContextException::class);

        $rule->validate(Context::create(null));
    }

    public function testRuleExecutionException(): void
    {
        $rule = new RuleExecutionExceptionTestRule();

        $this->expectException(RuleExecutionException::class);

        try {
            $rule->validate(Context::create(null));
        } catch (RuleExecutionException $exception) {
            self::assertEquals(RuleExecutionExceptionTestRule::class, $exception->getRuleClassName());
            throw $exception;
        }
    }

    public function testThrowable(): void
    {
        $rule = new ThrowableTestRule();

        $this->expectException(RuleExecutionException::class);

        try {
            $rule->validate(Context::create(null));
        } catch (RuleExecutionException $exception) {
            self::assertEquals(ThrowableTestRule::class, $exception->getRuleClassName());
            self::assertEquals('throwable_test_rule_exception_message', $exception->getMessage());
            self::assertEquals(0, $exception->getCode());
            self::assertEquals(new Exception('throwable_test_rule_exception_message'), $exception->getPrevious());
            throw $exception;
        }
    }

    public function testGetDefaultValidResult(): void
    {
        $rule = new DefaultValidResultTestRule();

        $result = $rule->validate(Context::create(null));

        self::assertTrue($result->isValid());
        self::assertNull($result->getFailedRuleCode());
    }

    public function testGetDefaultInvalidResult(): void
    {
        $rule = new DefaultInvalidResultTestRule();

        $result = $rule->validate(Context::create(null));

        self::assertFalse($result->isValid());
        self::assertEquals('default_invalid_result_test_rule', $result->getFailedRuleCode());
    }
}
