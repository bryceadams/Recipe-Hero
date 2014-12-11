<?php
/**
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * @package Recipe_Hero_Admin
 * @author  Captain Theme <info@captaintheme.com>
 */

if ( ! class_exists( 'Recipe_Hero_Admin' ) ) {

	class Recipe_Hero_Admin {

		/**
		 * Instance of this class.
		 *
		 * @since    0.5.0
		 *
		 * @var      object
		 */
		protected static $instance = null;

		/**
		 * Slug of the plugin screen.
		 *
		 * @since    0.5.0
		 *
		 * @var      string
		 */
		protected $plugin_screen_hook_suffix = null;

		/**
		 * Initialize the plugin by loading admin scripts & styles and adding a
		 * settings page and menu.
		 *
		 * @since     1.0.0
		 */
		private function __construct() {

			// Plugin Slug
			$this->plugin_slug = 'recipe-hero';

			add_action( 'init', array( $this, 'includes' ) );
			add_action( 'current_screen', array( $this, 'conditonal_includes' ) );

			// Load admin style sheet and JavaScript.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		}

		/**
		 * Return an instance of this class.
		 *
		 * @since     1.0.0
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
		 * Includes Files
		 **/

		public function includes() {

			// Let's make the magic happen on the backend
			include_once( 'rh-admin-functions.php' );
			include_once( 'class-rh-admin-settings.php' );

			include_once( 'class-rh-admin-ordering.php' );
			include_once( 'rh-help-tab.php' );
			include_once( 'rh-columns.php' );
			include_once( 'class-rh-admin-tweaks.php' );
			include_once( 'class-rh-admin-scripts.php' );

			// Meta boxes
			include_once( 'class-rh-admin-meta-boxes.php' );
			include_once( 'meta-boxes/class-rh-meta-box-recipe-reviews.php' );

			include( 'class-rh-admin-notices.php' );
			include( 'class-rh-admin-menus.php' );
			include( 'class-rh-admin-extensions.php' );
			include( 'class-rh-admin-welcome.php' );

		}

		/**
		 * Include admin files conditionally
		 */
		public function conditonal_includes() {
			$screen = get_current_screen();

			switch ( $screen->id ) {
				case 'dashboard' :
					//include( 'class-wc-admin-dashboard.php' );
				break;
				case 'options-permalink' :
					include( 'class-rh-admin-permalink-settings.php' );
				break;
				case 'users' :
				case 'user' :
				case 'profile' :
				case 'user-edit' :
					//include( 'class-wc-admin-profile.php' );
				break;
			}
		}

		/**
		 * Register and enqueue admin-specific style sheet.
		 *
		 * @since     0.5.0
		 *
		 * @return    null    Return early if no settings page is registered.
		 */
		public function enqueue_admin_styles() {

			if ( recipe_hero_admin_get_current_post_type() == 'recipe' ) {
				wp_enqueue_style( $this->plugin_slug .'-admin-styles', RH()->plugin_url() . '/assets/admin/css/admin.css', array(), RecipeHero::$version );
			}

		}

		/**
		 * Register and enqueue admin-specific JavaScript.
		 *
		 * @since     0.5.0
		 *
		 * @return    null    Return early if no settings page is registered.
		 */
		public function enqueue_admin_scripts() {

			if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
				return;
			}

			$screen = get_current_screen();
			if ( $this->plugin_screen_hook_suffix == $screen->id ) {
				wp_enqueue_script( $this->plugin_slug . '-admin-script', RH()->plugin_url() . '/assets/admin/js/admin.js', array( 'jquery' ), Recipe_Hero::VERSION );
			}

		}

	}

}
