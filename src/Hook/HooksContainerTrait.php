<?php

namespace WpPlus\WpOopBase\Hook;

trait HooksContainerTrait
{
    /**
     * Repository array of attached hooks
     * @var AbstractHook[]
     */
    private array $hooks = [];

    public function addHook(AbstractHook $hook): static
    {
        $this->hooks[] = $hook;
        return $this;
    }

    protected final function registerHooks(): void
    {
        foreach($this->hooks as $hook)
        {
            $hook->register();
        }
    }
}
