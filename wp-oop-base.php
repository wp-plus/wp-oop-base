<?php

/**
 * Plugin Name: WP OOP Base
 * Description: Opinionated OOP base for WordPress plugin and theme development.
 * Version: 2.0.1
 * Author: WP+ (https://github.com/wp-plus)
 *
 * If you want to use this plugin as a must-use plugin, please move this file to the "mu-plugins" folder (only this
 * file, everything else should stay in the "plugins" folder).
 */

namespace WpPlus\WpOopBase;

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// If you want to have this as a must-use plugin, simply copy or move this file from the regular "plugins/wp-oop-base"
// folder to the "mu-plugins" folder. Everything else can (should) stay in the "plugins" folder, especially when using
// Composer for dependency management.
// Since this bootstrap file can be present in both the "mu-plugins" and the regular "plugins" folder, make sure we run
// it only once.
if (defined('WP_PLUS_WP_OOP_BASE_IS_LOADED')) {
    return;
}
define('WP_PLUS_WP_OOP_BASE_IS_LOADED', TRUE);

// Ensure WP_PLUGIN_DIR is defined
if (!defined('WP_PLUGIN_DIR')) {
    define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
}

require_once WP_PLUGIN_DIR . '/wp-oop-base/lib/autoload.php';
