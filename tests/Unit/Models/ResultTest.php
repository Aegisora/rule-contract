<?php

namespace Aegisora\RuleContract\tests\Unit\Models;

use Aegisora\RuleContract\Models\Result;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    private static function assertResultDataEqualsExpected(
        Result $actual,
        array $expected
    ): void {
        self::assertEquals($expected['isValid'], $actual->isValid());
        self::assertEquals($expected['failedRuleCode'], $actual->getFailedRuleCode());
    }
}
