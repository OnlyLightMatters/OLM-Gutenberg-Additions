<?php

namespace OLM\GutenbergAdditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OLM_GA_Document {

	const META_HIDE_TITLE = '_olm_ga_hide_title';

	public static function init() {

		add_action( 'init', [ __CLASS__, 'register_meta' ] );
		add_action( 'enqueue_block_editor_assets', [ __CLASS__, 'enqueue_editor_assets' ] );

		add_filter( 'the_title', [ __CLASS__, 'filter_title' ], 10, 2 );

	}

	public static function register_meta() {

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

	public static function enqueue_editor_assets() {

		wp_enqueue_script(
			'olm-ga-document',
			OLM_GA_URL . 'modules/document/olm-document.js',
			[
				'wp-components',
				'wp-data',
				'wp-edit-post',
				'wp-element',
				'wp-i18n',
				'wp-plugins',
			],
			OLM_GA_VERSION,
			true
		);

	}

	public static function filter_title( $title, $post_id ) {

		if ( is_admin() ) {
			return $title;
		}

		if ( ! is_singular() ) {
			return $title;
		}

		if ( get_the_ID() !== (int) $post_id ) {
			return $title;
		}

		if ( get_post_meta( $post_id, self::META_HIDE_TITLE, true ) ) {
			return '';
		}

		return $title;

	}

}