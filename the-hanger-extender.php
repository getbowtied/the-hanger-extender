<?php
	/**
	 * Plugin Name: The Hanger Extender
	 * Plugin URI: https://thehanger.wp-theme.design/
	 * Description: Extends the functionality of The Hanger with theme specific shortcodes and page builder elements.
	 * Version: 1.1
	 * Author: GetBowtied
	 * Author URI: https://getbowtied.com
	 * Requires at least: 4.9
	 * Tested up to: 4.9
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

function gbt_th_gutenberg_blocks() {

	if( is_plugin_active( 'gutenberg/gutenberg.php' ) || is_wp_version('>=', '5.0') ) {
		include_once 'includes/gbt-blocks/index.php';
	} else {
		add_action( 'admin_notices', 'theme_warning' );
	}
}
add_action( 'init', 'gbt_th_gutenberg_blocks' );

if (!function_exists('theme_warning')){
	function theme_warning() {

		echo '<div class="message error woocommerce-admin-notice woocommerce-st-inactive woocommerce-not-configured">';
		echo '<p>GetBowtied Custom Gutenberg Blocks is enabled but not effective. Please activate Gutenberg plugin in order to work.</p>';
		echo '</div>';
	}
}

if(!function_exists('is_wp_version')) {
	function is_wp_version( $operator = '>', $version = '4.0' ) {

		global $wp_version;

		return version_compare( $wp_version, $version, $operator );
	}
}
