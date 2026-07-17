(function (wp) {
	'use strict';

	const { __ } = wp.i18n;
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editPost;
	const { CheckboxControl } = wp.components;
	const { createElement: el } = wp.element;
	const { useSelect, useDispatch } = wp.data;

	const META_KEY = '_olm_ga_hide_title';

	function OLM_GA_DocumentPanel() {

		const meta = useSelect(
			( select ) =>
				select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {},
			[]
		);

		const { editPost } = useDispatch( 'core/editor' );

		return el(
			PluginDocumentSettingPanel,
			{
				name: 'olm-ga-document',
				title: __( 'Document Properties', 'olm-gutenberg-additions' ),
			},
			el( CheckboxControl, {
				label: __( 'Hide title on frontend', 'olm-gutenberg-additions' ),
				checked: !! meta[ META_KEY ],
				onChange: ( checked ) => {
					editPost( {
						meta: {
							...meta,
							[ META_KEY ]: checked,
						},
					} );
				},
			} )
		);

	}

	registerPlugin( 'olm-ga-document', {
		render: OLM_GA_DocumentPanel,
	} );

})( window.wp );