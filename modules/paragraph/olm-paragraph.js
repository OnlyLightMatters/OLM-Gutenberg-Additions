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
 * Interactivity and UX of the Paragraph module
 */

(function (wp) {
	'use strict';

	const { __ } = wp.i18n;

	const { createHigherOrderComponent } = wp.compose;
	const { BlockControls } = wp.blockEditor;
	const { ToolbarGroup, ToolbarButton } = wp.components;
	const { Fragment, createElement: el } = wp.element;
	const { addFilter } = wp.hooks;

	const OLM_GA_SUPPORTED_BLOCKS = [
		'core/paragraph',
	];

	const OLM_GA_CLASS_JUSTIFY = 'has-text-align-justify';

	/**
	 * Returns true if the block contains the given CSS class.
	 *
	 * @param {Object} attributes Block attributes.
	 * @returns {boolean}
	 */
	function hasClass(attributes) {
		return (attributes.className || '')
			.split(/\s+/)
			.includes(OLM_GA_CLASS_JUSTIFY);
	}

	/**
	 * Toggle the justify CSS class.
	 *
	 * @param {Object} props Block properties.
	 */
	function toggleJustify(props) {

		const classes = (props.attributes.className || '')
			.split(/\s+/)
			.filter(Boolean);

		const index = classes.indexOf(OLM_GA_CLASS_JUSTIFY);

		if (index >= 0) {
			classes.splice(index, 1);
		} else {
			classes.push(OLM_GA_CLASS_JUSTIFY);
		}

		props.setAttributes({
			className: classes.join(' '),
		});

	}

	const OLM_GA_AddJustifyControl = createHigherOrderComponent(
		(BlockEdit) => {

			return (props) => {

				if (!OLM_GA_SUPPORTED_BLOCKS.includes(props.name)) {
					return el(BlockEdit, props);
				}

				const isActive = hasClass(props.attributes);

				return el(
					Fragment,
					{},
					el(BlockEdit, props),
					el(
						BlockControls,
						{},
						el(
							ToolbarGroup,
							{},
 							el(ToolbarButton, {
 								icon: 'editor-justify',
								label: __('Justify', 'olm-gutenberg-additions'),
 								isActive: isActive,
 								onClick: () => toggleJustify(props),
 							})
						)
					)
				);

			};

		},
		'OLM_GA_AddJustifyControl'
	);

	addFilter(
		'editor.BlockEdit',
		'olm-ga/paragraph-justify',
		OLM_GA_AddJustifyControl
	);

})(window.wp);