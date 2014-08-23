<?php
/**
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

/**
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 */

if ( ! class_exists( 'Recipe_Hero' ) ) {
	
	class Recipe_Hero {

		/**
		 * Plugin version, used for cache-busting of style and script file references.
		 *
		 * @since   0.9.0
		 *
		 * @var     string
		 */
		const VERSION = '0.9.0';

		/**
		 * The variable name is used as the text domain when internationalizing strings
		 * of text. Its value should match the Text Domain file header in the main
		 * plugin file.
		 *
		 * @since    0.5.0
		 *
		 * @var      string
		 */
		protected $plugin_slug = 'recipe-hero';

		/**
		 * Instance of this class.
		 *
		 * @since    0.5.0
		 *
		 * @var      object
		 */
		protected static $instance = null;

		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 *
		 * @since     0.9.0
		 */
		private function __construct() {

			// Load plugin text domain
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			// Activate plugin when new blog is added
			add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

			// Just in case
			add_theme_support( 'post-thumbnails' );

			// Let's make the magic happen.
		 	// <em>The ingredients to our recipe.</em>
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-frontend-scripts.php' );

			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-fields.php' );
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-cpt.php' );
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-tax.php' );

			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-settings.php' );
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-settings-functions.php' );

			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-templates.php' );
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-templates-functions.php' );
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-templates-hooks.php' );

			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-classes.php' );
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-shortcodes.php' );
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-general-functions.php' );
			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-image-sizes.php' );

			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-lightbox.php' );

			require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/public/rh-schema.php' );

		}


		/**
		 * Return the plugin slug.
		 *
		 * @since    0.5.0
		 *
		 * @return    Plugin slug variable.
		 */
		public function get_plugin_slug() {
			return $this->plugin_slug;
		}

		/**
		 * Return an instance of this class.
		 *
		 * @since     0.5.0
		 *
		 * @return    object    A single instance of this class.
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;

		}

		/**
		 * Fired when the plugin is activated.
		 *
		 * @since    0.5.0
		 *
		 * @param    boolean    $network_wide    True if WPMU superadmin uses
		 *                                       "Network Activate" action, false if
		 *                                       WPMU is disabled or plugin is
		 *                                       activated on an individual blog.
		 */
		public static function activate( $network_wide ) {

			if ( function_exists( 'is_multisite' ) && is_multisite() ) {

				if ( $network_wide  ) {

					// Get all blog ids
					$blog_ids = self::get_blog_ids();

					foreach ( $blog_ids as $blog_id ) {

						switch_to_blog( $blog_id );
						self::single_activate();

						restore_current_blog();
					}

				} else {
					self::single_activate();
				}

			} else {
				self::single_activate();
			}

		}


		/**
		 * Fired when a new site is activated with a WPMU environment.
		 *
		 * @since    0.5.0
		 *
		 * @param    int    $blog_id    ID of the new blog.
		 */
		public function activate_new_site( $blog_id ) {

			if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
				return;
			}

			switch_to_blog( $blog_id );
			self::single_activate();
			restore_current_blog();

		}

		/**
		 * Get all blog ids of blogs in the current network that are:
		 * - not archived
		 * - not spam
		 * - not deleted
		 *
		 * @since    0.5.0
		 *
		 * @return   array|false    The blog ids, false if no matches.
		 */
		private static function get_blog_ids() {

			global $wpdb;

			// get an array of blog ids
			$sql = "SELECT blog_id FROM $wpdb->blogs
				WHERE archived = '0' AND spam = '0'
				AND deleted = '0'";

			return $wpdb->get_col( $sql );

		}

		/**
		 * Fired for each blog when the plugin is activated.
		 *
		 * @since    0.5.0
		 */
		private static function single_activate() {
			// @TODO: Define activation functionality here
			// @TODO: Add plugin activation message here?
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since    0.5.0
		 */
		public function load_plugin_textdomain() {

			$domain = $this->plugin_slug;
			$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

			load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

		}

	}

}