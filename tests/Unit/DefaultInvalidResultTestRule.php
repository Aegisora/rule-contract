<?php

namespace Aegisora\RuleContract\tests\Unit;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\Rule;

class DefaultInvalidResultTestRule extends Rule
{
    protected function executeValidate(Context $context): Result
    {
        return $this->getDefaultInvalidResult();
    }
}
