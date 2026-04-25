<?php

namespace Aegisora\RuleContract;

use Aegisora\RuleContract\Exceptions\RuleException;
use Aegisora\RuleContract\Exceptions\RuleExecutionException;
use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use ReflectionClass;
use Throwable;

abstract class Rule implements RuleInterface
{
    private const DEFAULT_CODE = 'rule';

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

    protected function getDefaultInvalidResult(): Result
    {
        return Result::invalid($this->getDefaultCode());
    }

    protected function getDefaultCode(): string
    {
        $shortClassName = (new ReflectionClass($this))->getShortName();
        $shortClassNameInSnakeCase = preg_replace('/(?<!^)[A-Z]/', '_$0', $shortClassName);

        return !is_null($shortClassNameInSnakeCase) ? strtolower($shortClassNameInSnakeCase) : self::DEFAULT_CODE;
    }
}
