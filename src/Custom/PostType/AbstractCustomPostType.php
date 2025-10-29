<?php

namespace WpPlus\WpOopBase\Custom\PostType;

use UnexpectedValueException;
use WpPlus\WpOopBase\Registrable\AbstractRegistrable;

/**
 * @api
 */
abstract class AbstractCustomPostType extends AbstractRegistrable
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

    public function register(): static
    {
        add_action('init', function() {
            $this->assertValidPostType();
            register_post_type(static::getPostType(), $this->getConfig());
        }, 0);
        return $this;
    }

    public function unregister(): static
    {
        $this->assertValidPostType();
        unregister_post_type(static::getPostType());
        return $this;
    }

    private function assertValidPostType(): void
    {
        if (empty(static::getPostType())) {
            throw new UnexpectedValueException(get_class($this) . ': Post type must not be empty!', 1518363774);
        }
    }
}
