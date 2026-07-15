<?php

namespace OLM\GutenbergAdditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin {

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

	public static function enqueue_editor_assets() {

		wp_enqueue_script(
			'olm-ga-editor',
			OLM_GA_URL . 'assets/js/editor.js',
			[],
			OLM_GA_VERSION,
			true
		);

		wp_enqueue_style(
			'olm-ga-editor',
			OLM_GA_URL . 'assets/css/editor.css',
			[],
			OLM_GA_VERSION
		);
	}

	public static function enqueue_frontend_assets() {

		wp_enqueue_style(
			'olm-ga-frontend',
			OLM_GA_URL . 'assets/css/frontend.css',
			[],
			OLM_GA_VERSION
		);

	}

}
