<?php
/**
 * Plugin Name:        Simple Page Access Restriction
 * Plugin URI:         https://www.pluginsandsnippets.com/downloads/simple-page-access-restriction/
 * Description:        This plugin offers a simple way to restrict visits to select pages only to logged-in users and allows for page redirection to a defined (login) page of your choice.
 * Version:            1.0.15
 * Author:             Plugins & Snippets
 * Author URI:         https://www.pluginsandsnippets.com/
 * Text Domain:        simple-page-access-restriction
 * Requires at least:  3.9
 * Tested up to:       6.1.1
 *
 * @package         Simple_Page_Access_Restriction
 * @author          PluginsandSnippets.com
 * @copyright       All rights reserved Copyright (c) 2022, PluginsandSnippets.com
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Simple_Page_Access_Restriction' ) ) {

	/**
	 * Main Simple_Page_Access_Restriction class
	 *
	 * @since       1.0.0
	 */
	class Simple_Page_Access_Restriction {

		/**
		 * @var         Simple_Page_Access_Restriction $instance The one true Simple_Page_Access_Restriction
		 * @since       1.0.0
		 */
		private static $instance;
		private static $admin_instance;
		private static $dependencies_message;
		
		public function __construct() {
				
		}


		/**
		 * Get active instance
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      object self::$instance The one true Simple_Page_Access_Restriction
		 */
		public static function instance() {

			if ( ! self::$instance ) {
				self::$instance = new Simple_Page_Access_Restriction();
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->load_textdomain();
				
				self::$instance->hooks();

				// load admin
				self::$admin_instance = new Simple_Page_Access_Restriction_Admin();
			}

			return self::$instance;
		}

		/**
		 * Setup plugin constants
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function setup_constants() {

			// Plugin related constants
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_VER', '1.0.14' );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_NAME', 'Simple Page Access Restriction' );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_URL', plugin_dir_url( __FILE__ ) );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_FILE', __FILE__ );

			// Action links constants
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_DOCUMENTATION_URL', 'https://www.pluginsandsnippets.com/' );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_OPEN_TICKET_URL', 'https://www.pluginsandsnippets.com/open-ticket/' );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_SUPPORT_URL', 'https://www.pluginsandsnippets.com/support/' );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_REVIEW_URL', 'https://wordpress.org/plugins/simple-page-access-restriction/#reviews' );

			// Licensing related constants
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_API_URL', 'https://www.pluginsandsnippets.com/' );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_PURCHASES_URL', 'https://www.pluginsandsnippets.com/purchases/' );
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_STORE_PRODUCT_ID', 00 );

			// Helper for min non-min script styles
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_LOAD_NON_MIN_SCRIPTS', false );

			// Endpoint for Receiving Subscription Requests
			define( 'SIMPLE_PAGE_ACCESS_RESTRICTION_SUBSCRIBE_URL', 'https://www.pluginsandsnippets.com/?ps-subscription-request=1' );
		}

		public static function get_admin_instance() {
			return self::$admin_instance;
		}

		/**
		 * Include necessary files
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function includes() {
			// Include Files
			require_once SIMPLE_PAGE_ACCESS_RESTRICTION_DIR . 'includes/admin/admin.php';
		}

		/**
		 * Run action and filter hooks
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 *
		 */
		private function hooks() {
			add_action( 'template_redirect', array( $this, 'check_page_access' ), 1 );
		}

		/**
		 * Checks if current request is for a restricted page
		 * If Yes, and Current User is not logged in then redirects
		 * user to configured Login Page or to Homepage (if not cofigured)
		 * 
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public function check_page_access() {
			if ( is_page() && ps_simple_par_is_page_restricted( get_queried_object_id() ) && ! is_user_logged_in() ) {
				
				$settings = ps_simple_par_get_settings();
				
				if ( ! empty( $settings['login_page'] ) && ! ps_simple_par_is_page_restricted( $settings['login_page'] ) ) {
					$redirect_url = get_permalink( $settings['login_page'] );
				} else {
					$redirect_url = home_url( '/' );
				}
				
				wp_redirect( apply_filters( 'ps_simple_par_redirect_url', $redirect_url ) );
				exit;
			}
		}

		/**
		 * Internationalization
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public function load_textdomain() {
			// Set filter for language directory
			$lang_dir = SIMPLE_PAGE_ACCESS_RESTRICTION_DIR . '/languages/';
			$lang_dir = apply_filters( 'plugin_template_ps_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'simple-page-access-restriction' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'simple-page-access-restriction', $locale );

			// Setup paths to current locale file
			$mofile_local   = $lang_dir . $mofile;
			$mofile_global  = WP_LANG_DIR . '/simple-page-access-restriction/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/simple-page-access-restriction/ folder
				load_textdomain( 'simple-page-access-restriction', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/simple-page-access-restriction/languages/ folder
				load_textdomain( 'simple-page-access-restriction', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'simple-page-access-restriction', false, $lang_dir );
			}
		}

	}   
}

/**
 * The main function responsible for returning the one true Simple_Page_Access_Restriction
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \Simple_Page_Access_Restriction The one true Simple_Page_Access_Restriction
 */
function ps_simple_par_get_instance() {
	return Simple_Page_Access_Restriction::instance();
}
add_action( 'plugins_loaded', 'ps_simple_par_get_instance' );

function ps_simple_par_load_functions() {
	require_once SIMPLE_PAGE_ACCESS_RESTRICTION_DIR . 'includes/functions.php';
}
add_action( 'init', 'ps_simple_par_load_functions' );
