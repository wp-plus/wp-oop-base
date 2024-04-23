<?php

namespace WpPlus\WpOopBase\Hook;

use WpPlus\WpOopBase\Common\Registrable\AbstractRegistrable;

abstract class AbstractMultiHook extends AbstractRegistrable
{
    /**
     * @var AbstractHook[]
     */
    protected array $hooks = [];

    public function __construct(AbstractHook ...$hooks)
    {
        $this->hooks = $hooks;
    }

    public final function register(): static
    {
        foreach($this->hooks as $hook) {
            $hook->register();
        }
        return $this;
    }

    public final function unregister(): static
    {
        foreach($this->hooks as $hook) {
            $hook->register();
        }
        return $this;
    }
}
