<?php

namespace WpPlus\WpOopBase\Common\Registrable;

use WpPlus\WpOopBase\Common\AllowStaticMethodCallsTrait;

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
