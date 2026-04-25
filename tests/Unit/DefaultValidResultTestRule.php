<?php

namespace Aegisora\RuleContract\Tests\Unit;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\Rule;

class DefaultValidResultTestRule extends Rule
{
    protected function executeValidate(Context $context): Result
    {
        return $this->getDefaultValidResult();
    }
}
