<?php

namespace Aegisora\RuleContract\Tests\Unit\Models;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\RuleContext;
use Aegisora\RuleContract\Tests\Unit\DefaultValidResultTestRule;
use PHPUnit\Framework\TestCase;

class RuleContextTest extends TestCase
{
    public function testCreate(): void
    {
        $rule = new DefaultValidResultTestRule();
        $context = Context::create('foo');

        self::assertRuleContextDataEqualsExpected(
            RuleContext::create($rule, $context),
            [
                'rule' => $rule,
                'context' => $context,
                'contextValue' => 'foo',
            ]
        );
    }

    public function testNewCreate(): void
    {
        $rule = new DefaultValidResultTestRule();
        $context = Context::create('foo');

        self::assertRuleContextDataEqualsExpected(
            new RuleContext($rule, $context),
            [
                'rule' => $rule,
                'context' => $context,
                'contextValue' => 'foo',
            ]
        );
    }

    private static function assertRuleContextDataEqualsExpected(
        RuleContext $actual,
        array $expected
    ): void {
        self::assertSame($expected['rule'], $actual->getRule());
        self::assertSame($expected['context'], $actual->getContext());
        self::assertSame($expected['contextValue'], $actual->getContextValue());
    }
}
