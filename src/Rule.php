<?php

namespace Aegisora\RuleContract;

use Aegisora\RuleContract\Exceptions\RuleException;
use Aegisora\RuleContract\Exceptions\RuleExecutionException;
use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Throwable;

abstract class Rule implements RuleInterface
{
    /**
     * @throws RuleException
     */
    abstract protected function executeValidate(Context $context): Result;

    public function validate(Context $context): Result
    {
        try {
            return $this->executeValidate($context);
        } catch (RuleException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            throw new RuleExecutionException(
                static::class,
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }
    }
}
