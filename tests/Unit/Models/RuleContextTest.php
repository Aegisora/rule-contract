<?php

namespace Aegisora\RuleContract\Tests\Unit\Models;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\RuleContext;
use Aegisora\RuleContract\Tests\Unit\DefaultValidResultTestRule;
use PHPUnit\Framework\TestCase;
use stdClass;

class RuleContextTest extends TestCase
{
    /**
     * @dataProvider contextValueProvider
     * @param mixed $value
     */
    public function testCreate($value): void
    {
        $rule = new DefaultValidResultTestRule();
        $context = Context::create($value);

        self::assertRuleContextDataEqualsExpected(
            RuleContext::create($rule, $context),
            [
                'rule' => $rule,
                'context' => $context,
                'contextValue' => $value,
            ]
        );
    }

    /**
     * @dataProvider contextValueProvider
     * @param mixed $value
     */
    public function testNewCreate($value): void
    {
        $rule = new DefaultValidResultTestRule();
        $context = Context::create($value);

        self::assertRuleContextDataEqualsExpected(
            new RuleContext($rule, $context),
            [
                'rule' => $rule,
                'context' => $context,
                'contextValue' => $value,
            ]
        );
    }

    /**
     * @dataProvider contextValueProvider
     * @param mixed $value
     */
    public function testCreateFromValue($value): void
    {
        $rule = new DefaultValidResultTestRule();

        $ruleContext = RuleContext::createFromValue($rule, $value);

        self::assertSame($rule, $ruleContext->getRule());
        self::assertSame($value, $ruleContext->getContextValue());
    }

    public static function contextValueProvider(): array
    {
        return [
            'string' => [
                'value' => 'foo',
            ],
            'empty string' => [
                'value' => '',
            ],
            'int' => [
                'value' => 42,
            ],
            'zero' => [
                'value' => 0,
            ],
            'negative int' => [
                'value' => -1,
            ],
            'float' => [
                'value' => 3.14,
            ],
            'bool true' => [
                'value' => true,
            ],
            'bool false' => [
                'value' => false,
            ],
            'null' => [
                'value' => null,
            ],
            'empty array' => [
                'value' => [],
            ],
            'list array' => [
                'value' => [1, 2, 3],
            ],
            'assoc array' => [
                'value' => ['key' => 'value'],
            ],
            'object' => [
                'value' => new stdClass(),
            ],
            'closure' => [
                'value' => static function (): void {
                }
            ],
        ];
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
