<?php

namespace WpPlus\WpOopBase\Hook;

use Closure;

abstract class AbstractHook
{
    abstract public function getName(): string;

    /**
     * Specifies the priority for this hook. Defaults to 10. Override it to specify another priority.
     */
    public function getPriority(): int
    {
        return 10;
    }

    /**
     * Specifies the number of arguments this hook accepts. Defaults to 1. Override it to specify another number.
     */
    public function getNumberOfAcceptedArgs(): int
    {
        return 1;
    }

    /**
     * This is the actual hook callable, that will be executed, when the hook is run.
     */
    abstract protected function callback(...$args);

    private Closure|null $finalCallback = null;

    /**
     * Method to be called to add the hook (action or filter).
     */
    public function register()
    {
        $this->finalCallback = function(...$args) {
            return $this->callback(...$args);
        };

        // add_action() is just an alias for add_filter(), so we are safe registering
        // both types of hooks with add_filter().
        return add_filter(
            $this->getName(),
            $this->finalCallback,
            $this->getPriority(),
            $this->getNumberOfAcceptedArgs()
        );
    }

    /**
     * Method to be called to remove the hook (action or filter).
     */
    public function unregister()
    {
        if (!$this->finalCallback) {
            return FALSE;
        }
        $return = remove_filter(
            $this->getName(),
            $this->finalCallback,
            $this->getPriority(),
            $this->getNumberOfAcceptedArgs()
        );
        $this->finalCallback = null;
        return $return;
    }
}
