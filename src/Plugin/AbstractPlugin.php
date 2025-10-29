<?php

namespace WpPlus\WpOopBase\Plugin;

use WpPlus\WpOopBase\Runnable\AbstractRunnable;

/**
 * Abstract class to be used as base for plugin classes.
 */
abstract class AbstractPlugin extends AbstractRunnable
{
    /**
     * Private constructor just to disable multiple instantiation.
     * Since there is no way to add arguments to subclass' constructor, dependencies should be set via setters.
     */
    protected function __construct() {}

    /**
     * The implementation of this method in the final sub-classes should contain the filters
     * & action hooks and any other initializations the final plugin may need.
     */
    abstract protected function main(): void;

    /**
     * @staticvar AbstractPlugin $instance
     */
    public static function getInstance(): static
    {
        static $instances = [];
        if (!array_key_exists(static::class, $instances)) {
            $instances[static::class] = new static();
        }
        return $instances[static::class];
    }

    /**
     * Kick off plugin execution.
     */
    public function run(): void
    {
        $this->main();
    }
}
