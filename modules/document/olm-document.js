(function (wp) {
	'use strict';

	const { __ } = wp.i18n;
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editPost;
	const { CheckboxControl } = wp.components;
	const { createElement: el } = wp.element;
	const { useSelect, useDispatch } = wp.data;

	const META_KEY = '_olm_ga_hide_title';

	function OLM_GA_HideTitlePanel() {

		const meta = useSelect((select) => {
			return select('core/editor').getEditedPostAttribute('meta') || {};
		}, []);

		const { editPost } = useDispatch('core/editor');

		const value = !!meta[META_KEY];

		return el(
			PluginDocumentSettingPanel,
			{
				name: 'olm-ga-document',
				title: __('Document Properties', 'olm-gutenberg-additions'),
			},
			el(CheckboxControl, {
				label: __('Hide title on frontend', 'olm-gutenberg-additions'),
				checked: value,
				onChange: (checked) => {
					editPost({
						meta: {
							...meta,
							[META_KEY]: checked,
						},
					});
				},
			})
		);

	}

	function updateTitleOpacity() {

		const title = document.querySelector( '.wp-block-post-title' );

		if ( ! title ) {
			return;
		}

		if ( wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ META_KEY ] ) {
			title.classList.add( 'olm-ga-hide-title' );
		} else {
			title.classList.remove( 'olm-ga-hide-title' );
		}

	}

	wp.data.subscribe( updateTitleOpacity );

	registerPlugin('olm-ga-document', {
		render: OLM_GA_HideTitlePanel,
	});

})(window.wp);