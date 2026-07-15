<?php
/**
 * Plugin Name: OLM Gutenberg Additions
 * Plugin URI: https://github.com/onlylightmatters/OLM-Gutenberg-Additions
 * Description: Lightweight enhancements for the WordPress Block Editor.
 * Version: 0.2.0
 * Requires at least: 6.7
 * Requires PHP: 8.1
 * Author: Yann
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: olm-gutenberg-additions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OLM_GA_VERSION', '0.2.0' );
define( 'OLM_GA_PATH', plugin_dir_path( __FILE__ ) );
define( 'OLM_GA_URL', plugin_dir_url( __FILE__ ) );

require_once OLM_GA_PATH . 'includes/class-olm-plugin.php';

OLM\GutenbergAdditions\Plugin::init();
