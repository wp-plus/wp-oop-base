<?php

namespace WpPlus\WpOopBase\Custom\Taxonomy;

use UnexpectedValueException;
use WpPlus\WpOopBase\Registrable\AbstractRegistrable;

abstract class AbstractCustomTaxonomy extends AbstractRegistrable
{
    /**
     * Key of the custom taxonomy.
     */
    abstract public static function getTaxonomy(): string;

    /**
     * This method should return an array of object types (https://codex.wordpress.org/Post_Types)
     * the taxonomy should be registered to.
     * E.g. ['post', 'some-custom-post-type']
     */
    abstract protected function getObjectTypes(): array;

    /**
     * This method should return the configuration array of the custom taxonomy.
     * See all configuration options: https://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    abstract protected function getConfig(): array;

    public function register(): static
    {
        add_action('init', function() {
            $this->assertValidTaxonomy();

            // https://codex.wordpress.org/Function_Reference/register_taxonomy#Usage
            register_taxonomy(static::getTaxonomy(), $this->getObjectTypes(), $this->getConfig());

            // Better be safe than sorry when registering custom taxonomies for custom post types.
            // Use register_taxonomy_for_object_type() right after the function to interconnect them.
            // Else you could run into "mine traps" where the post type isn't attached inside filter callback
            // that run during parse_request or pre_get_posts.
            foreach($this->getObjectTypes() as $objectType) {
                register_taxonomy_for_object_type(static::getTaxonomy(), $objectType);
            }
        }, 0);
        return $this;
    }

    public function unregister(): static
    {
        foreach($this->getObjectTypes() as $objectType) {
            unregister_taxonomy_for_object_type(static::getTaxonomy(), $objectType);
        }
        unregister_taxonomy(static::getTaxonomy());
        return $this;
    }

    private function assertValidTaxonomy(): void
    {
        if (empty(static::getTaxonomy())) {
            throw new UnexpectedValueException(get_class($this) . ': Taxonomy must not be empty!', 1544694369);
        }
    }
}
