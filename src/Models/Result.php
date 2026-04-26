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

    public static function valid(): self
    {
        return new self(true);
    }

    public static function invalid(string $failedRuleCode): self
    {
        return new self(false, $failedRuleCode);
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
