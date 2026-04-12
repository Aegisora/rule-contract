<?php

namespace Aegisora\RuleContract\tests\unit\Models;

use Aegisora\RuleContract\Models\Context;
use PHPUnit\Framework\TestCase;

class ContextTest extends TestCase
{
    private static function assertContextDataEqualsExpected(
        Context $actual,
        array $expected
    ): void {
        self::assertEquals($expected['value'], $actual->getValue());
    }
}
