<?php

namespace Aegisora\RuleContract\Tests\Unit;

use Aegisora\RuleContract\Models\Context;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    public function testGetDefaultInvalidResult(): void
    {
        $rule = new DefaultInvalidResultTestRule();
        $result = $rule->validate(Context::create(null));

        $this->assertFalse($result->isValid());
        $this->assertEquals('default_invalid_result_test_rule', $result->getFailedRuleCode());
    }
}
