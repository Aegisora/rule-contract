<?php

namespace Aegisora\RuleContract\Models;

class Result
{
    private bool $isValid;
    private ?string $failedRuleCode;

    public function __construct(
        bool $isValid,
        ?string $failedRuleCode = null
    ) {
        $this->isValid = $isValid;
        $this->failedRuleCode = $failedRuleCode;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getFailedRuleCode(): ?string
    {
        return $this->failedRuleCode;
    }
}
