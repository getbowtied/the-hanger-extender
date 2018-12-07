<?php
	/**
	 * Plugin Name: The Hanger Extender
	 * Plugin URI: https://thehanger.wp-theme.design/
	 * Description: Extends the functionality of The Hanger with theme specific shortcodes and page builder elements.
	 * Version: 1.3
	 * Author: GetBowtied
	 * Author URI: https://getbowtied.com
	 * Requires at least: 5.0
	 * Tested up to: 5.0
	 *
	 * @package  The Hanger Extender
	 * @author GetBowtied
	 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$theme = wp_get_theme();
if ( $theme->template != 'the-hanger') {
	return;
}

include_once( 'includes/shortcodes/wp/socials.php' );
include_once( 'includes/shortcodes/wp/slider.php' );
include_once( 'includes/shortcodes/wp/blog-posts.php' );
include_once( 'includes/shortcodes/wp/custom-button.php' );
include_once( 'includes/shortcodes/wc/woocommerce_products_user_bought.php' );

/******************************************************************************/
/* Plugin Updater *************************************************************/
/******************************************************************************/

add_action( 'init', 'github_th_plugin_updater' );
if(!function_exists('github_th_plugin_updater')) {
	function github_th_plugin_updater() {

		include_once 'updater.php';

		define( 'WP_GITHUB_FORCE_UPDATE', true );

		if ( is_admin() ) {

			$config = array(
				'slug' 				 => plugin_basename(__FILE__),
				'proper_folder_name' => 'the-hanger-extender',
				'api_url' 			 => 'https://api.github.com/repos/getbowtied/the-hanger-extender',
				'raw_url' 			 => 'https://raw.github.com/getbowtied/the-hanger-extender/master',
				'github_url' 		 => 'https://github.com/getbowtied/the-hanger-extender',
				'zip_url' 			 => 'https://github.com/getbowtied/the-hanger-extender/zipball/master',
				'sslverify'			 => true,
				'requires'			 => '5.0',
				'tested'			 => '5.0',
				'readme'			 => 'README.txt',
				'access_token'		 => '',
			);

			new WP_GitHub_Updater( $config );
		}
	}
}

/******************************************************************************/
/* Add Shortcodes to VC *******************************************************/
/******************************************************************************/

if ( defined(  'WPB_VC_VERSION' ) ) {
	
	add_action( 'init', 'getbowtied_visual_composer_shortcodes' );
	function getbowtied_visual_composer_shortcodes() {
		
		// Add new WP shortcodes to VC
		
		include_once( 'includes/shortcodes/vc/wp/slider.php' );
		include_once( 'includes/shortcodes/vc/wp/blog-posts.php' );
		include_once( 'includes/shortcodes/vc/wp/custom-button.php' );
	
	}
}

include_once( 'includes/functions/actions.php' );

/******************************************************************************/
/* Add Gutenberg Blocks *******************************************************/
/******************************************************************************/

add_action( 'init', 'gbt_th_gutenberg_blocks' );
if(!function_exists('gbt_th_gutenberg_blocks')) {
	function gbt_th_gutenberg_blocks() {

		if( is_plugin_active( 'gutenberg/gutenberg.php' ) || is_wp_version('>=', '5.0') ) {
			include_once 'includes/gbt-blocks/index.php';
		}
	}
}

if(!function_exists('is_wp_version')) {
	function is_wp_version( $operator = '>', $version = '4.0' ) {

		global $wp_version;

		return version_compare( $wp_version, $version, $operator );
	}
}
