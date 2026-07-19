<?php

namespace OLM\GutenbergAdditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load the different modules.
 */
require_once OLM_GA_PATH . 'modules/paragraph/class-olm-paragraph.php';
require_once OLM_GA_PATH . 'modules/document/class-olm-document.php';
require_once OLM_GA_PATH . 'modules/cover/class-olm-cover.php';

/**
 * Main plugin bootstrap.
 *
 * This class is responsible for initializing the plugin and loading
 * all available feature modules.
 *
 * Business logic must remain inside individual modules.
 */
class OLM_GA_Plugin {

	/**
	 * Initialize the plugin.
	 *
	 * Loads every available module.
	 *
	 * @return void
	 */
	public static function init() {

		add_action( 'init', [ __CLASS__, 'load_textdomain' ] );

		OLM_GA_Paragraph::init();
		OLM_GA_Document::init();
		OLM_GA_Cover::init();

	}

	/**
	 * Load plugin translations.
	 *
	 * @return void
	 */
	public static function load_textdomain() {

		load_plugin_textdomain(
			'olm-gutenberg-additions',
			false,
			dirname( plugin_basename( OLM_GA_FILE ) ) . '/languages'
		);

	}

}