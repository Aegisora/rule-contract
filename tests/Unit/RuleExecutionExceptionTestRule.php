<?php

namespace Aegisora\RuleContract\Tests\Unit;

use Aegisora\RuleContract\Exceptions\RuleExecutionException;
use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\Rule;

class RuleExecutionExceptionTestRule extends Rule
{
    protected function executeValidate(Context $context): Result
    {
        throw new RuleExecutionException(static::class);
    }
}
