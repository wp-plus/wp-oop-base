<?php

namespace WpPlus\WpOopBase\Custom\PostType;

abstract class AbstractCustomPostType
{
    /**
     * Key of the custom post type.
     */
    abstract public static function getPostType(): string;

    /**
     * This method should return the configuration array of the custom post type.
     * See all configuration options: https://codex.wordpress.org/Function_Reference/register_post_type
     */
    abstract protected function getConfig(): array;

    public function register(): void
    {
        add_action('init', function() {
            if (empty(static::getPostType())) {
                throw new \UnexpectedValueException(get_class($this) . ': Post type must not be empty!', 1518363774);
            }
            register_post_type(static::getPostType(), $this->getConfig());
        }, 0);
    }
}

/* EOF */
