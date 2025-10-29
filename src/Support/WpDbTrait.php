<?php

namespace WpPlus\WpOopBase\Support;

use wpdb;

trait WpDbTrait
{
    /**
     * Simply returns the global $wpdb object.
     * @global wpdb $wpdb
     * @return wpdb
     */
    protected function wpdb(): wpdb
    {
        global $wpdb;
        return $wpdb;
    }
}
