<?php
	/**
	 * Plugin Name: The Hanger Extender
	 * Plugin URI: https://thehanger.wp-theme.design/
	 * Description: Extends the functionality of The Hanger with theme specific shortcodes and page builder elements.
	 * Version: 1.6.3
	 * Author: GetBowtied
	 * Author URI: https://getbowtied.com
	 * Requires at least: 5.0
	 * Tested up to: 5.3.1
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

global $theme;

/******************************************************************************/
/* Plugin Updater *************************************************************/
/******************************************************************************/

require( dirname( __FILE__ ) . '/core/updater/plugin-update-checker.php' );
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/getbowtied/the-hanger-extender/master/core/updater/assets/plugin.json',
	__FILE__,
	'the-hanger-extender'
);

if ( ! class_exists( 'TheHangerExtender' ) ) :

	/**
	 * TheHangerExtender class.
	*/
	class TheHangerExtender {

		/**
		 * The single instance of the class.
		 *
		 * @var TheHangerExtender
		*/
		protected static $_instance = null;

		/**
		 * TheHangerExtender constructor.
		 *
		*/
		public function __construct() {

			$theme = wp_get_theme();
			$parent_theme = $theme->parent();

			// Helpers
			include_once( dirname( __FILE__ ) . '/includes/helpers/helpers.php' );

			if ( $theme->template == 'the-hanger') {
				include_once( dirname( __FILE__ ) . '/includes/shortcodes/wp/slider.php' );
				include_once( dirname( __FILE__ ) . '/includes/shortcodes/wp/blog-posts.php' );
				include_once( dirname( __FILE__ ) . '/includes/shortcodes/wp/custom-button.php' );
				include_once( dirname( __FILE__ ) . '/includes/shortcodes/wc/woocommerce_products_user_bought.php' );

				// Add Shortcodes to VC
				if ( defined(  'WPB_VC_VERSION' ) ) {

					add_action( 'init', function() {

						// Add new WP shortcodes to VC
						include_once( dirname( __FILE__ ) . '/includes/shortcodes/vc/wp/slider.php' );
						include_once( dirname( __FILE__ ) . '/includes/shortcodes/vc/wp/blog-posts.php' );
						include_once( dirname( __FILE__ ) . '/includes/shortcodes/vc/wp/custom-button.php' );
					});
				}
			}

			// Gutenberg Blocks
			add_action( 'init', array( $this, 'gbt_th_gutenberg_blocks' ) );

			if( $theme->template == 'the-hanger' && ( $theme->version >= '1.5.1' || ( !empty($parent_theme) && $parent_theme->version >= '1.5.1' ) ) ) {

				// Widgets
				include_once( dirname( __FILE__ ) . '/includes/widgets/widget-ecommerce-info.php' );
				include_once( dirname( __FILE__ ) . '/includes/widgets/widget-product-categories-with-icon.php' );
			}

			if( $theme->template == 'the-hanger' && ( $theme->version >= '1.5.2' || ( !empty($parent_theme) && $parent_theme->version >= '1.5.2' ) ) ) {

				// Customizer
				include_once( dirname( __FILE__ ) . '/includes/customizer/class/class-control-toggle.php' );

				// Addons
				include_once( dirname( __FILE__ ) . '/includes/addons/woocommerce-category-header.php' );
				include_once( dirname( __FILE__ ) . '/includes/addons/woocommerce-category-icon.php' );

				// Social Media
				include_once( dirname( __FILE__ ) . '/includes/social-media/class-social-media.php' );

				// Social Sharing
				include_once( dirname( __FILE__ ) . '/includes/social-sharing/class-social-sharing.php' );
			}
		}

		/**
		 * Loads Gutenberg blocks
		 *
		 * @return void
		*/
		public function gbt_th_gutenberg_blocks() {

			if( is_plugin_active( 'gutenberg/gutenberg.php' ) || is_wp_version('>=', '5.0') ) {
				include_once( dirname( __FILE__ ) . '/includes/gbt-blocks/index.php' );
			} else {
				add_action( 'admin_notices', 'gbt_th_theme_warning' );
			}
		}

		/**
		 * Ensures only one instance of TheHangerExtender is loaded or can be loaded.
		 *
		 * @return TheHangerExtender
		*/
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
	}
endif;

$thehanger_extender = new TheHangerExtender;
