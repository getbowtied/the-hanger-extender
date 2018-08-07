<?php

// Social Media Profiles

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


add_action( 'enqueue_block_editor_assets', 'getbowtied_th_socials_editor_assets' );

if ( ! function_exists( 'getbowtied_th_socials_editor_assets' ) ) {
    function getbowtied_th_socials_editor_assets() {
    	
        wp_enqueue_script(
            'getbowtied-socials',
            plugins_url( 'block.js', __FILE__ ),
            array( 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element', 'jquery' )
        );

        wp_enqueue_style(
            'getbowtied-socials-styles',
            plugins_url( 'css/editor.css', __FILE__ ),
            array( 'wp-edit-blocks' )
        );
    }
}

add_action( 'enqueue_block_assets', 'getbowtied_th_socials_assets' );

if ( ! function_exists( 'getbowtied_th_socials_assets' ) ) {
    function getbowtied_th_socials_assets() {
        
        wp_enqueue_style(
            'getbowtied-socials-css',
            plugins_url( 'css/style.css', __FILE__ ),
            array()
        );
    }
}

register_block_type( 'getbowtied/th-socials', array(
	'attributes'     			=> array(
		'items_align'			=> array(
			'type'				=> 'string',
			'default'			=> 'left',
		),
        'fontSize'              => array(
            'type'              => 'number',
            'default'           => '16',
        ),
        'fontColor'             => array(
            'type'              => 'string',
            'default'           => '#000',
        ),
	),

	'render_callback' => 'getbowtied_th_render_frontend_socials',
) );

function get_th_social_media_icons() {
    $socials = array(
        array( 
            'link' => 'facebook_link',
            'icon' => 'thehanger-icons-facebook-f',
            'name' => 'Facebook'
        ),
        array( 
            'link' => 'twitter_link',
            'icon' => 'thehanger-icons-twitter',
            'name' => 'Twitter'
        ),
        array( 
            'link' => 'pinterest_link',
            'icon' => 'thehanger-icons-pinterest',
            'name' => 'Pinterest'
        ),
        array( 
            'link' => 'linkedin_link',
            'icon' => 'thehanger-icons-linkedin',
            'name' => 'Linkedin'
        ),
        array( 
            'link' => 'googleplus_link',
            'icon' => 'thehanger-icons-google2',
            'name' => 'Google+'
        ),
        array( 
            'link' => 'rss_link',
            'icon' => 'thehanger-icons-rss',
            'name' => 'RSS'
        ),
        array( 
            'link' => 'tumblr_link',
            'icon' => 'thehanger-icons-tumblr',
            'name' => 'Tumblr'
        ),
        array( 
            'link' => 'instagram_link',
            'icon' => 'thehanger-icons-instagram',
            'name' => 'Instagram'
        ),
        array( 
            'link' => 'youtube_link',
            'icon' => 'thehanger-icons-youtube2',
            'name' => 'Youtube'
        ),
        array( 
            'link' => 'vimeo_link',
            'icon' => 'thehanger-icons-vimeo',
            'name' => 'Vimeo'
        ),
        array( 
            'link' => 'behance_link',
            'icon' => 'thehanger-icons-behance',
            'name' => 'Behance'
        ),
        array( 
            'link' => 'dribbble_link',
            'icon' => 'thehanger-icons-dribbble',
            'name' => 'Dribbble'
        ),
        array( 
            'link' => 'flickr_link',
            'icon' => 'thehanger-icons-flickr',
            'name' => 'Flickr'
        ),
        array( 
            'link' => 'git_link',
            'icon' => 'thehanger-icons-github',
            'name' => 'Git'
        ),
        array( 
            'link' => 'skype_link',
            'icon' => 'thehanger-icons-skype',
            'name' => 'Skype'
        ),
        array( 
            'link' => 'weibo_link',
            'icon' => 'thehanger-icons-sina-weibo',
            'name' => 'Weibo'
        ),
        array( 
            'link' => 'foursquare_link',
            'icon' => 'thehanger-icons-foursquare2',
            'name' => 'Foursquare'
        ),
        array( 
            'link' => 'soundcloud_link',
            'icon' => 'thehanger-icons-soundcloud',
            'name' => 'Soundcloud'
        ),
        array( 
            'link' => 'snapchat_link',
            'icon' => 'thehanger-icons-snapchat',
            'name' => 'Snapchat'
        ),
    );

    return $socials;
}

function getbowtied_th_render_frontend_socials($attributes) {

	extract(shortcode_atts(
		array(
			'items_align' => 'left',
            'fontSize'    => '16',
            'fontColor'   => '#000',
		), $attributes));
    ob_start();

    $socials = get_th_social_media_icons();

    $output = '<div class="wp-block-gbt-social-media">';

        $output .= '<ul class="shortcode_socials ' . esc_html($items_align) . '">';

        foreach($socials as $social) {

        	if ( GBT_Opt::getOption($social['link']) != "" ) {
        		$output .= '<li>';
        		$output .= '<a target="_blank" style="color:'.$fontColor.';font-size:'.$fontSize.'px" href="' . GBT_Opt::getOption($social['link']) . '">';
                $output .= '<i class="' . $social['icon'] . '"></i>';
        		$output .= '<span class="' . $social['name'] . '"></span>';
        		$output .= '</a></li>';
        	}
        }

        $output .= '</ul>';

    $output .= '</div>';

	ob_end_clean();

	return $output;
}