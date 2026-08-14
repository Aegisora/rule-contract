<?php

namespace Aegisora\RuleContract\Models;

use Countable;
use Iterator;

/**
 * @implements Iterator<int, RuleContext>
 */
class RuleContextCollection implements Iterator, Countable
{
    /**
     * @var RuleContext[]
     */
    private array $ruleContexts;

    private int $position = 0;

    public function __construct(
        RuleContext ...$ruleContexts
    ) {
        $this->ruleContexts = $ruleContexts;
    }

    public static function create(
        RuleContext ...$ruleContexts
    ): self {
        return new self(...$ruleContexts);
    }

    /**
     * @return RuleContext[]
     */
    public function toArray(): array
    {
        return $this->ruleContexts;
    }

    public function current(): RuleContext
    {
        return $this->ruleContexts[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return array_key_exists($this->position, $this->ruleContexts);
    }

    public function count(): int
    {
        return count($this->ruleContexts);
    }

    public function isEmpty(): bool
    {
        return $this->ruleContexts === [];
    }
}
