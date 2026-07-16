<?php

namespace OLM\GutenbergAdditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Document module.
 *
 * Adds document-level features to the Block Editor.
 */
class OLM_GA_Document {

	/**
	 * Post meta key.
	 */
	const META_HIDE_TITLE = '_olm_ga_hide_title';

	/**
	 * Initialize the module.
	 *
	 * @return void
	 */
	public static function init() {

		add_action( 'init', [ __CLASS__, 'register_post_meta' ] );

		add_action(
			'enqueue_block_editor_assets',
			[ __CLASS__, 'enqueue_editor_assets' ]
		);

		add_filter(
			'render_block_core/post-title',
			[ __CLASS__, 'render_post_title' ],
			10,
			2
		);

	}

	/**
	 * Register post meta.
	 *
	 * @return void
	 */
	public static function register_post_meta() {

		register_post_meta(
			'',
			self::META_HIDE_TITLE,
			[
				'type'              => 'boolean',
				'single'            => true,
				'default'           => false,
				'show_in_rest'      => true,
				'sanitize_callback' => 'rest_sanitize_boolean',
				'auth_callback'     => static function () {
					return current_user_can( 'edit_posts' );
				},
			]
		);

	}

	/**
	 * Enqueue editor assets.
	 *
	 * @return void
	 */
	public static function enqueue_editor_assets() {

		wp_enqueue_script(
			'olm-ga-document',
			OLM_GA_URL . 'modules/document/olm-document.js',
			[
				'wp-block-editor',
				'wp-components',
				'wp-compose',
				'wp-data',
				'wp-edit-post',
				'wp-element',
				'wp-i18n',
				'wp-plugins',
			],
			OLM_GA_VERSION,
			true
		);

		wp_set_script_translations(
			'olm-ga-document',
			'olm-gutenberg-additions',
			OLM_GA_PATH . 'languages'
		);

		wp_enqueue_style(
			'olm-ga-document',
			OLM_GA_URL . 'modules/document/olm-document.css',
			[],
			OLM_GA_VERSION
		);

	}

	/**
	 * Hide the Post Title block on the frontend when requested.
	 *
	 * @param string $block_content Rendered block.
	 * @param array  $block         Parsed block.
	 *
	 * @return string
	 */
	public static function render_post_title( $block_content, $block ) {

		if ( is_admin() ) {
			return $block_content;
		}

		if ( ! is_singular() ) {
			return $block_content;
		}

		if ( get_post_meta( get_the_ID(), self::META_HIDE_TITLE, true ) ) {
			return '';
		}

		return $block_content;

	}

}