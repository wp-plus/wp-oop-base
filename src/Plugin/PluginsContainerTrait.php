<?php

namespace WpPlus\WpOopBase\Plugin;

trait PluginsContainerTrait
{
    /**
     * Repository array of plugin objects.
     * @var AbstractPlugin[]
     */
    private array $plugins = [];

    public function addPlugin(AbstractPlugin|string $plugin): static
    {
        if (is_string($plugin)) {
            $this->plugins[] = $plugin::getInstance();
        }
        elseif ($plugin instanceof AbstractPlugin) {
            $this->plugins[] = $plugin;
        }
        return $this;
    }

    /**
     * @return AbstractPlugin[]
     */
    public function getPlugins(): array
    {
        return $this->plugins;
    }

    protected final function runPlugins(): void
    {
        foreach($this->plugins as $plugin)
        {
            $plugin->run();
        }
    }
}
