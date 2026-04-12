<?php

namespace Aegisora\RuleContract\Models;

class Context
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct(
        $value
    ) {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     */
    public static function create(
        $value
    ): self {
        return new self($value);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
