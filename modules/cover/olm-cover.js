/*
 * OLM Gutenberg Additions
 *
 * @package OLM_Gutenberg_Additions
 * @author Only Light Matters
 *
 * @link https://github.com/onlylightmatters/olm-gutenberg-additions
 *
 * @license GPL-2.0-or-later
 */

/*
 * Javascript customizations
 * Interactivity and UX of the Cover module
 */


(function (wp) {
	'use strict';

	const { __ } = wp.i18n;
	const { addFilter } = wp.hooks;
	const { createHigherOrderComponent } = wp.compose;
	const { Fragment } = wp.element;
	const { InspectorControls, URLInputButton } = wp.blockEditor;
	const { PanelBody, ToggleControl } = wp.components;

	/**
	 * Add controls to Cover block.
	 */
	const withInspectorControls = createHigherOrderComponent((BlockEdit) => {

		return (props) => {

			if (props.name !== 'core/cover') {
				return <BlockEdit {...props} />;
			}

			const {
				attributes: {
					olmHref,
					olmOpensInNewTab,
				},
				setAttributes,
			} = props;

			return (
				<Fragment>
					<BlockEdit {...props} />

					<InspectorControls>
						<PanelBody
							title={__('Cover Link', 'olm-gutenberg-additions')}
							initialOpen={true}
						>

							<URLInputButton
								url={olmHref}
								onChange={(url) =>
									setAttributes({
										olmHref: url,
									})
								}
							/>

							<ToggleControl
								label={__('Open in new tab', 'olm-gutenberg-additions')}
								checked={olmOpensInNewTab}
								onChange={(value) =>
									setAttributes({
										olmOpensInNewTab: value,
									})
								}
							/>

						</PanelBody>
					</InspectorControls>

				</Fragment>
			);

		};

	}, 'withInspectorControls');

	addFilter(
		'editor.BlockEdit',
		'olm-ga/cover/controls',
		withInspectorControls
	);

})(window.wp);