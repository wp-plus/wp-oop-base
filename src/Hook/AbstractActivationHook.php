<?php

namespace WpPlus\WpOopBase\Hook;

abstract class AbstractActivationHook extends AbstractHook
{
    private ?string $mainPluginFile = null;

    public function __construct(string $mainPluginFile)
    {
        $this->mainPluginFile = $mainPluginFile;
    }

    public function getName(): string
    {
        $file = plugin_basename($this->mainPluginFile);
        return sprintf('activate_', $file);
    }
}
