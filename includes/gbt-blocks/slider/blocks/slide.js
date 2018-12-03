( function( blocks, i18n, element ) {

	const el = element.createElement;

	/* Blocks */
	const registerBlockType   	= wp.blocks.registerBlockType;

	const InspectorControls 	= wp.editor.InspectorControls;
	const InnerBlock 			= wp.editor.InnerBlocks;
	const MediaUpload			= wp.editor.MediaUpload;
	const RichText				= wp.editor.RichText;
	const AlignmentToolbar		= wp.editor.AlignmentToolbar;
    const BlockControls       	= wp.editor.BlockControls;
    const ColorSettings			= wp.editor.PanelColorSettings;

	const TextControl 			= wp.components.TextControl;
	const SelectControl			= wp.components.SelectControl;
	const PanelBody				= wp.components.PanelBody;
	const ToggleControl			= wp.components.ToggleControl;
	const Button 				= wp.components.Button;
	const RangeControl			= wp.components.RangeControl;

	const SVG 					= wp.components.SVG;
	const Path 					= wp.components.Path;
	const Circle 				= wp.components.Circle;
	const Polygon 				= wp.components.Polygon;

	/* Register Block */
	registerBlockType( 'getbowtied/th-slide', {
		title: i18n.__( 'Slide' ),
		icon:
			el( SVG, { xmlns:'http://www.w3.org/2000/svg', viewBox:'0 0 100 100' },
				el( Path, { d:'M85,15H15v60h70V15z M20,70v-9l15-15l9,9L29,70H20z M36,70l19-19l21,19H36z M80,66.8L54.9,44l-7.4,7.4L35,39 L20,54V20h60V66.8z' } ),
				el( Path, { d:'M65,40c4.1,0,7.5-3.4,7.5-7.5S69.1,25,65,25s-7.5,3.4-7.5,7.5S60.9,40,65,40z M65,30c1.4,0,2.5,1.1,2.5,2.5 S66.4,35,65,35s-2.5-1.1-2.5-2.5S63.6,30,65,30z' } ) 
			),
		category: 'thehanger',
		parent: [ 'getbowtied/th-slider' ],
		attributes: {
		    imgURL: {
	            type: 'string',
	            attribute: 'src',
	            selector: 'img',
	            default: '',
	        },
	        imgID: {
	            type: 'number',
	        },
	        imgAlt: {
	            type: 'string',
	            attribute: 'alt',
	            selector: 'img',
	        },
	        title: {
	        	type: 'string',
	        	default: 'Slide Title',
	        },
	        description: {
	        	type: 'string',
	        	default: 'Slide Description'
	        },
	        textColor: {
	        	type: 'string',
	        	default: '#fff'
	        },
	        buttonText: {
	        	type: 'string',
	        	default: 'Button Text'
	        },
	        slideURL: {
	        	type: 'string',
	        	default: '#'
	        },
	        slideButton: {
	        	type: 'boolean',
	        	default: true
	        },
	        backgroundColor: {
	        	type: 'string',
	        	default: '#24282e'
	        },
	        alignment: {
	        	type: 'string',
	        	default: 'center'
	        },
	        tabNumber: {
                type: "number"
            }
		},

		edit: function( props ) {

			var attributes = props.attributes;

			return [
				el(
					InspectorControls,
					{ 
						key: 'gbt_18_th_slide_inspector'
					},
					el(
						'div',
						{
							className: 'main-inspector-wrapper',
						},
						el(
							TextControl,
							{
								key: "gbt_18_th_editor_slide_link",
	              				label: i18n.__( 'Slide Link' ),
	              				type: 'text',
	              				value: attributes.slideURL,
	              				onChange: function( newText ) {
									props.setAttributes( { slideURL: newText } );
								},
							},
						),
						el( 'hr', {} ),
						el(
							ToggleControl,
							{
								key: "gbt_18_th_editor_slide_button",
	              				label: i18n.__( 'Slide Button' ),
	              				checked: attributes.slideButton,
	              				onChange: function() {
									props.setAttributes( { slideButton: ! attributes.slideButton } );
								},
							}
						),
						el(
							ColorSettings,
							{
								key: 'gbt_18_th_editor_slide_colors',
								initialOpen: false,
								title: i18n.__( 'Colors' ),
								colorSettings: [
									{ 
										label: i18n.__( 'Text Color' ),
										value: attributes.textColor,
										onChange: function( newColor) {
											props.setAttributes( { textColor: newColor } );
										},
									},
									{ 
										label: i18n.__( 'Slide Background' ),
										value: attributes.backgroundColor,
										onChange: function( newColor) {
											props.setAttributes( { backgroundColor: newColor } );
										}
									}
								]
							},
						),
					),
				),
				el( 'div', 
					{ 
						key: 		'gbt_18_th_editor_slide_wrapper',
						className : 'gbt_18_th_editor_slide_wrapper'
					},
					el(
						MediaUpload,
						{
							key: 'gbt_18_th_editor_slide_image',
							allowedTypes: [ 'image' ],
							buttonProps: { className: 'components-button button button-large' },
	              			value: attributes.imgID,
							onSelect: function( img ) {
								props.setAttributes( {
									imgID: img.id,
									imgURL: img.url,
									imgAlt: img.alt,
								} );
							},
	              			render: function( img ) { 
	              				return [
		              				! attributes.imgID && el(
		              					Button, 
		              					{ 
		              						key: 'gbt_18_th_slide_add_image_button',
		              						className: 'gbt_18_th_slide_add_image_button button add_image',
		              						onClick: img.open
		              					},
		              					i18n.__( 'Add Image' )
	              					), 
	              					!! attributes.imgID && el(
	              						Button, 
										{
											key: 'gbt_18_th_slide_remove_image_button',
											className: 'gbt_18_th_slide_remove_image_button button remove_image',
											onClick: function() {
												img.close;
												props.setAttributes({
									            	imgID: null,
									            	imgURL: null,
									            	imgAlt: null,
									            });
											}
										},
										i18n.__( 'Remove Image' )
									), 
	              				];
	              			},
						},
					),
					el(
						BlockControls,
						{ 
							key: 'gbt_18_th_editor_slide_alignment'
						},
						el(
							AlignmentToolbar, 
							{
								key: 'gbt_18_th_editor_slide_alignment_control',
								value: attributes.alignment,
								onChange: function( newAlignment ) {
									props.setAttributes( { alignment: newAlignment } );
								}
							} 
						),
					),
					el(
						'div',
						{
							key: 		'gbt_18_th_editor_slide_wrapper',
							className: 	'gbt_18_th_editor_slide_wrapper',
							style:
							{
								backgroundColor: attributes.backgroundColor,
								backgroundImage: 'url(' + attributes.imgURL + ')'
							},
						},
						el(
							'div',
							{
								key: 		'gbt_18_th_editor_slide_content',
								className: 	'gbt_18_th_editor_slide_content',
							},
							el(
								'div',
								{
									key: 		'gbt_18_th_editor_slide_container',
									className: 	'gbt_18_th_editor_slide_container align-' + attributes.alignment,
									style:
									{
										textAlign: attributes.alignment
									}
								},
								el(
									'div',
									{
										key: 		'gbt_18_th_editor_slide_title',
										className: 	'gbt_18_th_editor_slide_title',
									},
									el(
										RichText, 
										{
											key: 'gbt_18_th_editor_slide_title_input',
											style:
											{ 
												color: attributes.textColor,
											},
											format: 'string',
											className: 'gbt_18_th_editor_slide_title_input',
											formattingControls: [],
											tagName: 'h2',
											value: attributes.title,
											placeholder: i18n.__( 'Add Title' ),
											onChange: function( newTitle) {
												props.setAttributes( { title: newTitle } );
											}
										}
									),
								),
								el(
									'div',
									{
										key: 		'gbt_18_th_editor_slide_description',
										className: 	'gbt_18_th_editor_slide_description',
									},
									el(
										RichText, 
										{
											key: 'gbt_18_th_editor_slide_description_input',
											style:
											{
												color: attributes.textColor,
											},
											className: 'gbt_18_th_editor_slide_description_input',
											format: 'string',
											tagName: 'p',
											value: attributes.description,
											formattingControls: [],
											placeholder: i18n.__( 'Add Subtitle' ),
											onChange: function( newSubtitle) {
												props.setAttributes( { description: newSubtitle } );
											}
										}
									),
								),
								!! attributes.slideButton && el(
									'div',
									{
										key: 		'gbt_18_th_editor_slide_button',
										className: 	'gbt_18_th_editor_slide_button',
									},
									el(
										RichText, 
										{
											key: 'gbt_18_th_editor_slide_button_input',
											className: 'gbt_18_th_editor_slide_button_input',
											format: 'string',
											tagName: 'h5',
											style:
											{
												color: attributes.textColor,
												borderColor: attributes.textColor,
											},
											value: attributes.buttonText,
											formattingControls: [],
											placeholder: i18n.__( 'Button Text' ),
											onChange: function( newText) {
												props.setAttributes( { buttonText: newText } );
											}
										}
									),
								),
							),
						),
					),
				),
			];
		},
		getEditWrapperProps: function( attributes ) {
            return { 
            	'data-tab': attributes.tabNumber 
            };
        },
		save: function( props ) {

			let attributes = props.attributes;

			return el( 'div', 
				{
					key: 		'gbt_18_th_swiper_slide', 
					className: 	'gbt_18_th_swiper_slide swiper-slide ' + attributes.alignment + '-align',
					style:
					{
						backgroundColor: attributes.backgroundColor,
						backgroundImage: 'url(' + attributes.imgURL + ')',
						color: attributes.textColor
					}
				},
				! attributes.slideButton && attributes.slideURL != '' && el( 'a',
					{
						key: 		'gbt_18_th_slide_fullslidelink',
						className: 	'fullslidelink',
						href: 		attributes.slideURL,
						'target': 	'_blank'
					}
				),
				el( 'div',
					{
						key: 					'gbt_18_th_slide_content',
						className: 				'gbt_18_th_slide_content slider-content',
						'data-swiper-parallax': '-1000'
					},
					el( 'div',
						{
							key: 		'gbt_18_th_slide_content_wrapper',
							className: 	'gbt_18_th_slide_content_wrapper slider-content-wrapper'
						},
						attributes.title != '' && el( 'h2',
							{
								key: 		'gbt_18_th_slide_title',
								className: 	'gbt_18_th_slide_title slide-title',
								style:
								{
									color: attributes.textColor
								}
							},
							attributes.title
						),
						attributes.description != '' && el( 'p',
							{
								key: 		'gbt_18_th_slide_description',
								className: 	'gbt_18_th_slide_description slide-description',
								style:
								{
									color: attributes.textColor
								}
							},
							attributes.description
						),
						!! attributes.slideButton && attributes.buttonText != '' && el( 'a',
							{
								key: 		'gbt_18_th_slide_button',
								className: 	'gbt_18_th_slide_button slide-button',
								href: attributes.slideURL,
								style:
								{
									color: attributes.textColor,
									borderColor: attributes.textColor,
								}
							},
							attributes.buttonText
						)
					)
				)
			);
		},
	} );

} )(
	window.wp.blocks,
	window.wp.i18n,
	window.wp.element,
	jQuery
);