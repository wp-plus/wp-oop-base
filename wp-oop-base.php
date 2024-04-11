<?php

/**
 * Plugin Name: WP OOP Base
 * Description: Opinionated OOP base for WordPress plugin and theme development.
 * Version: 1.0.0-alpha
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

// Since this bootstrap file can be either in the "mu-plugins" folder or the regular "plugins", make sure we run it
// only once. Normally, this file should be moved from the regular "plugins/wp-oop-base" folder to the "mu-plugins" folder
// right after installation (when it is desired to have it as a "must use" plugin), it can happen that this files gets
// copied (so duplicated).
if (defined('WP_PLUS_WP_OOP_BASE_IS_LOADED')) {
    return;
}
define('WP_PLUS_WP_OOP_BASE_IS_LOADED', TRUE);

require_once __DIR__ . '/lib/autoload.php';
