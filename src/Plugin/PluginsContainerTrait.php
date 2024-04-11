<?php

namespace WpPlus\WpOopBase\Plugin;

trait PluginsContainerTrait
{
    /**
     * Repository array of plugin objects.
     * @var AbstractPlugin[]
     */
    private array $plugins = [];

    public function addPlugin(AbstractPlugin $plugin): static
    {
        $this->plugins[] = $plugin;
        return $this;
    }

    protected final function runPlugins(): void
    {
        foreach($this->plugins as $plugin)
        {
            $plugin->run();
        }
    }
}
