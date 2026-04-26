<?php

namespace Aegisora\RuleContract\Exceptions;

use Throwable;

class RuleExecutionException extends RuleException
{
    private string $ruleClassName;

    public function __construct(
        string $ruleClassName,
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->ruleClassName = $ruleClassName;
    }

    public function getRuleClassName(): string
    {
        return $this->ruleClassName;
    }
}
