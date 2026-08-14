<?php

namespace Aegisora\RuleContract\Models;

use Aegisora\RuleContract\RuleInterface;

class RuleContext
{
    private RuleInterface $rule;
    private Context $context;

    public function __construct(
        RuleInterface $rule,
        Context $context
    ) {
        $this->rule = $rule;
        $this->context = $context;
    }

    public static function create(
        RuleInterface $rule,
        Context $context
    ): self {
        return new self($rule, $context);
    }

    public function getRule(): RuleInterface
    {
        return $this->rule;
    }

    /**
     * @return mixed
     */
    public function getContextValue()
    {
        return $this->getContext()->getValue();
    }

    public function getContext(): Context
    {
        return $this->context;
    }
}
