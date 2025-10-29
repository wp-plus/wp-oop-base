<?php

namespace WpPlus\WpOopBase\Runnable;

use WpPlus\WpOopBase\Support\AllowStaticMethodCallsTrait;

/**
 * @method static static runInstance()
 */
abstract class AbstractRunnable implements RunnableInterface
{
    use AllowStaticMethodCallsTrait;

    /**
     * @inheritDoc
     */
    static private function getMethodsAllowedToBeCalledStatically(): array
    {
        return ['run'];
    }
}
