<?php

namespace WpPlus\WpOopBase\Support;

use BadMethodCallException;

/**
 * Allows selected methods to be called statically on classes that use this trait.
 * The classes must implement the getMethodsAllowedToBeCalledStatically() method, which should return the name of
 * methods that are allowed to be statically called.
 * The static method name will always be the original method name + the "Instance" keyword.
 * Example:
 * `SomeClass::methodInstance()` will call $instanceOfSomeClass->method().
 * Note: for every static call, a new instance of the class in question will be created.
 */
trait AllowStaticMethodCallsTrait
{
    /**
     * Should return the names of (non-static) methods that are allowed to be called statically.
     * @return string[]
     */
    abstract static private function getMethodsAllowedToBeCalledStatically(): array;

    static public function __callStatic(string $name, array $arguments): mixed
    {
        if (!str_ends_with($name, 'Instance')) {
            throw new BadMethodCallException(sprintf('Invalid static method name: %s::%s()', static::class, $name), 1713788272);
        }

        $name = preg_replace('/Instance$/', '', $name);

        if (!in_array($name, static::getMethodsAllowedToBeCalledStatically())) {
            throw new BadMethodCallException(sprintf('Method not found: %s::%s()', static::class, $name), 1713776366);
        }

        return (new static())->$name(...$arguments);
    }
}
