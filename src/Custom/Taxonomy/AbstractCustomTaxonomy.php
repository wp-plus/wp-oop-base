<?php

namespace WpPlus\WpOopBase\Custom\Taxonomy;

abstract class AbstractCustomTaxonomy
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

    public function register(): void
    {
        add_action('init', function() {
            if (empty(static::getTaxonomy())) {
                throw new \UnexpectedValueException(get_class($this) . ': Taxonomy must not be empty!', 1544694369);
            }

            // https://codex.wordpress.org/Function_Reference/register_taxonomy#Usage
            register_taxonomy(static::getTaxonomy(), $this->getObjectTypes(), $this->getConfig());

            // Better be safe than sorry when registering custom taxonomies for custom post types.
            // Use register_taxonomy_for_object_type() right after the function to interconnect them.
            // Else you could run into minetraps where the post type isn't attached inside filter callback
            // that run during parse_request or pre_get_posts.
            foreach($this->getObjectTypes() as $object_type) {
                register_taxonomy_for_object_type(static::getTaxonomy(), $object_type);
            }
        }, 0);
    }
}

/* EOF */
