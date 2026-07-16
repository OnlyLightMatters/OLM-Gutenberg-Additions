<?php

namespace OLM\GutenbergAdditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load the Paragraph module.
 */
require_once OLM_GA_PATH . 'modules/paragraph/class-olm-paragraph.php';
require_once OLM_GA_PATH . 'modules/document/class-olm-document.php';

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

		OLM_GA_Paragraph::init();
		OLM_GA_Document::init();

		/* Not useful yet
		
		OLM_GA_Cover::init();
		
		*/
		
	}

}