<?php

namespace Aegisora\RuleContract\Tests\Unit;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;
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

    public function testGetDefaultInvalidResult(): void
    {
        $rule = new DefaultInvalidResultTestRule();
        $result = $rule->validate(Context::create(null));

        $this->assertFalse($result->isValid());
        $this->assertEquals('default_invalid_result_test_rule', $result->getFailedRuleCode());
    }
}
