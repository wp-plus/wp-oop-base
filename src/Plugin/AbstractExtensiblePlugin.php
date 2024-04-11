<?php

namespace WpPlus\WpOopBase\Plugin;

/**
 * Abstract class to be used as base for plugin classes which can contain other sub-plugins.
 */
abstract class AbstractExtensiblePlugin extends AbstractPlugin
{
    use PluginsContainerTrait;

    /**
     * Kick off plugin execution.
     */
    public function run(): void
    {
        parent::run();
        $this->runPlugins();
    }
}
