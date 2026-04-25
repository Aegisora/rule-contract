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
            $this->assertEquals(RuleExecutionExceptionTestRule::class, $exception->getRuleClassName());
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
            $this->assertEquals(ThrowableTestRule::class, $exception->getRuleClassName());
            $this->assertEquals('throwable_test_rule_exception_message', $exception->getMessage());
            $this->assertEquals(0, $exception->getCode());
            $this->assertEquals(new Exception('throwable_test_rule_exception_message'), $exception->getPrevious());
            throw $exception;
        }
    }

    public function testGetDefaultValidResult(): void
    {
        $rule = new DefaultValidResultTestRule();
        $result = $rule->validate(Context::create(null));

        $this->assertTrue($result->isValid());
        $this->assertNull($result->getFailedRuleCode());
    }

    public function testGetDefaultInvalidResult(): void
    {
        $rule = new DefaultInvalidResultTestRule();
        $result = $rule->validate(Context::create(null));

        $this->assertFalse($result->isValid());
        $this->assertEquals('default_invalid_result_test_rule', $result->getFailedRuleCode());
    }
}
