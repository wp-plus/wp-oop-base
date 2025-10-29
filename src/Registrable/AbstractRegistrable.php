<?php

namespace WpPlus\WpOopBase\Registrable;

use WpPlus\WpOopBase\Support\AllowStaticMethodCallsTrait;

/**
 * @method static static registerInstance()
 */
abstract class AbstractRegistrable implements RegistrableInterface
{
    use AllowStaticMethodCallsTrait;

    /**
     * @inheritDoc
     */
    static private function getMethodsAllowedToBeCalledStatically(): array
    {
        return ['register'];
    }
}
