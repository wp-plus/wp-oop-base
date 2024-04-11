<?php

namespace WpPlus\WpOopBase\Plugin;

use WpPlus\WpOopBase\Hook\HooksContainerTrait;

/**
 * Abstract class to be used as base for plugin classes.
 */
abstract class AbstractPlugin
{
    use HooksContainerTrait;

    /**
     * Private constructor just to disable multiple instantiation.
     * Since there is no way to add arguments to subclass' constructor, dependencies should be set via setters.
     */
    private function __construct() {}

    /**
     * The implementation of this method in the final sub-classes should contain the filters
     * & action hooks and any other initializations the final plugin may need.
     */
    abstract protected function setup(): void;

    /**
     * @staticvar AbstractPlugin $instance
     */
    public static function getInstance(): static
    {
        static $instance = NULL;
        if (NULL === $instance) {
            $instance = new static();
        }
        return $instance;
    }

    /**
     * Kick off plugin execution.
     */
    public function run(): void
    {
        $this->setup();
        $this->registerHooks();
    }
}
