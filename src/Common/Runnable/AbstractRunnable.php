<?php

namespace WpPlus\WpOopBase\Common\Runnable;

use WpPlus\WpOopBase\Common\AllowStaticMethodCallsTrait;

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