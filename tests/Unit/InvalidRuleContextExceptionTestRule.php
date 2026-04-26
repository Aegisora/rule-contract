<?php

namespace Aegisora\RuleContract\Tests\Unit;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;
use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\Rule;

class InvalidRuleContextExceptionTestRule extends Rule
{
    protected function executeValidate(Context $context): Result
    {
        throw new InvalidRuleContextException();
    }
}
