<?php

namespace OLM\GutenbergAdditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Paragraph module.
 *
 * Restores the Justify alignment option for the Paragraph block.
 */
class OLM_GA_Paragraph {

	/**
	 * Initialize the module.
	 *
	 * Registers editor and frontend assets.
	 *
	 * @return void
	 */
	public static function init() {

		add_action(
			'enqueue_block_editor_assets',
			[ __CLASS__, 'enqueue_editor_assets' ]
		);

		add_action(
			'wp_enqueue_scripts',
			[ __CLASS__, 'enqueue_frontend_assets' ]
		);

	}

	/**
	 * Enqueue editor assets.
	 *
	 * @return void
	 */
	public static function enqueue_editor_assets() {

		wp_enqueue_script(
			'olm-ga-paragraph',
			OLM_GA_URL . 'modules/paragraph/olm-paragraph.js',
			[
				'wp-block-editor',
				'wp-components',
				'wp-compose',
				'wp-element',
				'wp-hooks',
			],
			OLM_GA_VERSION,
			true
		);

		wp_enqueue_style(
			'olm-ga-paragraph',
			OLM_GA_URL . 'modules/paragraph/olm-paragraph.css',
			[],
			OLM_GA_VERSION
		);

	}

	/**
	 * Enqueue frontend assets.
	 *
	 * @return void
	 */
	public static function enqueue_frontend_assets() {

		wp_enqueue_style(
			'olm-ga-paragraph',
			OLM_GA_URL . 'modules/paragraph/olm-paragraph.css',
			[],
			OLM_GA_VERSION
		);

	}

}