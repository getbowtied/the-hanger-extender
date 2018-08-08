<?php

// Slider

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'enqueue_block_editor_assets', 'getbowtied_th_slider_editor_assets' );

if ( ! function_exists( 'getbowtied_th_slider_editor_assets' ) ) {
	function getbowtied_th_slider_editor_assets() {

		wp_enqueue_script(
			'getbowtied-slide',
			plugins_url( 'slide.js', __FILE__ ),
			array( 'wp-blocks', 'wp-i18n', 'wp-element' )
		);
		
		wp_enqueue_script(
			'getbowtied-slider',
			plugins_url( 'slider.js', __FILE__ ),
			array( 'wp-blocks', 'wp-i18n', 'wp-element' )
		);

		wp_enqueue_script(
			'getbowtied-slider-settings',
			plugins_url( 'editor.js', __FILE__ ),
			array( 'jquery' )
		);

		wp_enqueue_style(
			'getbowtied-slider',
			plugins_url( 'css/editor.css', __FILE__ ),
			array( 'wp-edit-blocks' )
		);
	}
}

add_action( 'enqueue_block_assets', 'getbowtied_th_slider_assets' );

if ( ! function_exists( 'getbowtied_th_slider_assets' ) ) {
	function getbowtied_th_slider_assets() {
		
		wp_enqueue_style(
			'getbowtied-slider-css',
			plugins_url( 'css/style.css', __FILE__ ),
			array()
		);
	}
}

register_block_type( 'getbowtied/th-slide', array(
	'attributes'      => array(
		'imgURL' 			=> array(
            'type' 			=> 'string',
        ),
	    'imgID' 			=> array(
			'type'			=> 'number',
		),
	    'imgAlt'			=> array(
            'type'			=> 'string',
	    ),
		'title' 			=> array(
			'type'			=> 'string',
			'default'		=> 'Slide Subtitle',
		),
		'description'		=> array(
			'type'			=> 'string',
			'default'		=> 'Slide Title',
		),
		'text_color'		=> array(
			'type'			=> 'string',
			'default'		=> '#fff',
		),
		'button_text'  		=> array(
			'type'    		=> 'string',
			'default' 		=> 'Button Text',
		),
		'button_url'		=> array(
			'type'	  		=> 'string',
			'default' 		=> '',
		),
		'bg_color'			=> array(
			'type'			=> 'string',
			'default'		=> '#24282e',
		),
		'alignment'			=> array(
			'type'			=> 'string',
			'default'		=> 'center'
		),
		'button_toggle'  	=> array(
			'type'			=> 'boolean',
			'default'		=> true
		)
	),

	'render_callback' => 'getbowtied_th_render_slide',
) );

function getbowtied_th_render_slide( $attributes ) {
	extract(shortcode_atts(array(
		'imgURL'					=> '',
       	'imgID' 					=> null,
	    'imgAlt'					=> '',
		'title' 					=> 'Slide Subtitle',
		'description' 				=> 'Slide Title',
		'text_color'				=> '#000',
		'button_text' 				=> 'Button Text',
		'button_url'				=> '',
		'bg_color'					=> '#fff',
		'alignment'					=> 'center',
		'button_toggle'				=> true
	), $attributes));

	switch ($alignment)
	{
		case 'left':
			$class = 'left-align';
			break;
		case 'right':
			$class = 'right-align';
			break;
		case 'center':
			$class = 'center-align';
	}

	if (!empty($description))
	{
		$description = '<h2 class="slide-title" style="color:'.$text_color.';">'.$description.'</h2>';
	} else {
		$description = "";
	}

	if (!empty($title))
	{
		$title = '<h3 class="slide-description" style="color:'.$text_color.';">'.$title.'</h3>';
	} else {
		$title = "";
	}

	if ($button_toggle && !empty($button_text))
	{
		$button = '<a class="slide-button" style="color:'.$text_color.';" href="'.$button_url.'">'.$button_text.'</a>';
	} else {
		$button = "";
	}

	if (!$button_toggle && !empty($button_url))
	{
		$slide_link = '<a href="'.$button_url.'" class="fullslidelink"></a>';
	}
	else 
	{
		$slide_link = '';
	}

	$getbowtied_image_slide = '
		
		<div class="swiper-slide '.$class.'" 
		style=	"background: '.$bg_color.' url('.$imgURL.') center center no-repeat ;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				color: '.$text_color.'">
			'.$slide_link.'
			<div class="slider-content" data-swiper-parallax="-1000">
				<div class="slider-content-wrapper">
					'.$description.'
					'.$title.'
					'.$button.'
				</div>
			</div>
		</div>';

	return $getbowtied_image_slide;
}