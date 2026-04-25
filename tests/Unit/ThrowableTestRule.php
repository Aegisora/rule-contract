<?php

namespace Aegisora\RuleContract\Tests\Unit;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\Rule;
use Exception;

class ThrowableTestRule extends Rule
{
    protected function executeValidate(Context $context): Result
    {
        throw new Exception('throwable_test_rule_exception_message');
    }
}
