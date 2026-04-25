<?php

namespace Aegisora\RuleContract;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;
use Aegisora\RuleContract\Exceptions\RuleExecutionException;
use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;

interface RuleInterface
{
    /**
     * @throws InvalidRuleContextException
     * @throws RuleExecutionException
     */
    public function validate(Context $context): Result;
}
