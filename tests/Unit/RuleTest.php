<?php

namespace Aegisora\RuleContract\Tests\Unit;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;
use Aegisora\RuleContract\Exceptions\RuleExecutionException;
use Aegisora\RuleContract\Models\Context;
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

    public function testGetDefaultInvalidResult(): void
    {
        $rule = new DefaultInvalidResultTestRule();
        $result = $rule->validate(Context::create(null));

        $this->assertFalse($result->isValid());
        $this->assertEquals('default_invalid_result_test_rule', $result->getFailedRuleCode());
    }
}
