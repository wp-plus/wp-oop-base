<?php

namespace WpPlus\WpOopBase\Helper;

use WP_Post;
use WP_Query;

class Post
{
    private function __construct()
    {
        // We do not want this class instantiated
    }

    /**
     * @api
     */
    static function getPostBySlug(string $slug, string $post_type = 'post'): ?WP_Post
    {
        $query = new WP_Query(
            array(
                'name'   => $slug,
                'post_type'   => $post_type,
                'numberposts' => 1,
            ) );
        $posts = $query->get_posts();
        return array_shift($posts);
    }

    /**
     * @api
     */
    static function getPostIdBySlug(string $slug, string $post_type = 'post'): ?int
    {
        $query = new WP_Query(
            array(
                'name'   => $slug,
                'post_type'   => $post_type,
                'numberposts' => 1,
                'fields'      => 'ids',
            ) );
        $posts = $query->get_posts();
        return array_shift($posts);
    }
}
