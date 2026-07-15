<?php

namespace OLM\GutenbergAdditions\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * OLM Cover Module
 * Extends core/cover block with link capability
 */
class OLM_Cover {

	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		add_action( 'enqueue_block_editor_assets', [ $this, 'olm_enqueue_editor_assets' ] );
		add_filter( 'render_block_core/cover', [ $this, 'olm_filter_cover_output' ], 10, 2 );
	}

	public function olm_enqueue_editor_assets() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		if ( ! $screen || 'post' !== $screen->base ) {
			return;
		}

		wp_enqueue_script(
			'olm-ga-cover',
			OLM_GA_URL . 'modules/cover/olm-cover.js',
			[],
			OLM_GA_VERSION,
			true
		);

		wp_enqueue_style(
			'olm-ga-cover-style',
			OLM_GA_URL . 'modules/cover/olm-cover.css',
			[],
			OLM_GA_VERSION
		);

		wp_localize_script(
			'olm-ga-cover',
			'olmCoverSettings',
			[
				'version' => OLM_GA_VERSION,
			]
		);
	}

	public function olm_filter_cover_output( $block_content, $block ) {
		if ( empty( $block['attrs']['olmLinkUrl'] ) ) {
			return $block_content;
		}

		$link_url   = esc_url( $block['attrs']['olmLinkUrl'] );
		$link_target = ! empty( $block['attrs']['olmLinkTarget'] ) ? '_blank' : '';
		$rel        = '_blank' === $link_target ? ' rel="noopener noreferrer"' : '';

		// Remplace l'href existant OU enveloppe l'image
		$pattern = '/(<a[^>]*href\s*=\s*["\'])([^"\']*)(["\'][^>]*>)/i';
		$replacement = sprintf('$1%s$3', esc_attr( $link_url ));
		$updated_content = preg_replace( $pattern, $replacement, $block_content, 1 );

		if ( $updated_content === $block_content && preg_match( '/<img[^>]+>/i', $block_content ) ) {
			$updated_content = preg_replace(
				'/(<img[^>]+>)/i',
				sprintf( '<a href="%1$s"%2$s%3$s</a>', esc_attr( $link_url ), $rel, '$1' ),
				$block_content,
				1
			);
		}

		return $updated_content;
	}
}

// Initialisation
OLM_Cover::instance();