<?php
/**
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 *
 * @wordpress-plugin
 * Plugin Name:       Recipe Hero
 * Plugin URI:        http://recipehero.in/
 * Description:       The last recipe plugin you'll ever need.
 * Version:           1.0.12
 * Author:            Bryce Adams
 * Author URI:        http://bryce.se/
 * Text Domain:       recipe-hero
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

if ( ! class_exists( 'RecipeHero' ) ) :
	
/**
 * Main RecipeHero Class
 *
 * @class RecipeHero
 * @version	1.0.12
 */

final class RecipeHero {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.12
	 *
	 * @var     string
	 */
	public static $version = '1.0.12';

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
	protected static $_instance = null;

	/**
	 * @var RH_Query $query
	 */
	public $query = null;

	/**
	 * @var RH_Integrations $integrations
	 */
	public $integrations = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'recipe-hero' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'recipe-hero' ), '1.0.0' );
	}

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	public function __construct() {

		// Define constants
		$this->define_constants();

		// Include Required Files
		$this->includes();

		// Hooks
		add_action( 'after_setup_theme', array( $this, 'setup_environment' ) );
		add_action( 'init', array( $this, 'init' ), 0 );

		// Loaded Action
		do_action( 'recipe_hero_loaded' );

	}

	/**
	 * Define WC Constants
	 */
	private function define_constants() {

		if ( ! defined( 'RH_PLUGIN_FILE' ) ) {
			define( 'RH_PLUGIN_FILE', __FILE__ );
		}

		if ( ! defined( 'RH_PLUGIN_BASENAME' ) ) {
			define( 'RH_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		}

		if ( ! defined( 'RH_VERSION' ) ) {
			define( 'RH_VERSION', self::$version );
		}

		if ( ! defined( 'RH_CMB2_DIR' ) ) {
			define( 'RH_CMB2_DIR', plugin_dir_path( __FILE__ ) . '/includes/fields/init.php' );
		}

		// Plugin Folder Path
		if( ! defined( 'RECIPE_HERO_PLUGIN_DIR' ) ) {
			define( 'RECIPE_HERO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Template Folder Path
		if( ! defined( 'RECIPE_HERO_TEMPLATE_DIR' ) ) {
			define( 'RECIPE_HERO_TEMPLATE_DIR', 'recipe-hero/' );
		}

	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	private function includes() {

		include_once( 'includes/rh-core-functions.php' );

		include_once( 'includes/class-rh-install.php' );

		include_once( 'includes/rh-fields.php' );
		include_once( 'includes/class-rh-post-types.php' );

		include_once( 'includes/class-rh-settings-methods.php' );

		include_once( 'includes/class-rh-comments.php' );

		include_once( 'includes/rh-templates.php' );
		include_once( 'includes/rh-templates-functions.php' );
		include_once( 'includes/rh-templates-hooks.php' );

		include_once( 'includes/rh-shortcodes.php' );

		include_once( 'includes/class-rh-lightbox.php' );
		include_once( 'includes/class-rh-frontend-scripts.php' );

		include_once( 'includes/rh-schema.php' );

		// Abstract Classes
		include_once( 'includes/abstracts/abstract-rh-recipe.php' );
		include_once( 'includes/abstracts/abstract-rh-settings-api.php' );
		include_once( 'includes/abstracts/abstract-rh-integration.php' );

		// Query Class
		$this->query = include( 'includes/class-rh-query.php' );

		if ( is_admin() ) {

			include_once( 'includes/admin/class-rh-admin.php' );
			add_action( 'plugins_loaded', array( 'Recipe_Hero_Admin', 'get_instance' ) );

		}

		// Classes (used on all pages)
		include_once( 'includes/class-rh-integrations.php' );
		include_once( 'includes/class-rh-cache-helper.php' );

	}


	/**
	 * Init Recipe Hero when WordPress Initialises.
	 */
	public function init() {

		// Before init action
		do_action( 'before_recipe_hero_init' );

		// Set up localisation
		$this->load_plugin_textdomain();

		// Load class instances
		$this->integrations = new RH_Integrations();	// Integrations class

		// Init action
		do_action( 'recipe_hero_init' );

	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'recipe-hero' );
		$dir    = trailingslashit( WP_LANG_DIR );

		/**
		 * Global Locale. Looks in:
		 *
		 * 		- WP_LANG_DIR/recipe-hero/recipe-hero-LOCALE.mo
		 * 	 	- recipe-hero/languages/recipe-hero-LOCALE.mo (which if not found falls back to:)
		 * 	 	- WP_LANG_DIR/plugins/recipe-hero-LOCALE.mo
		 */
		load_textdomain( 'recipe-hero', $dir . 'recipe-hero/recipe-hero-' . $locale . '.mo' );
		load_plugin_textdomain( 'recipe-hero', false, plugin_basename( dirname( __FILE__ ) ) . "/languages" );
	}

	/**
	 * Ensure theme and server variable compatibility and setup image sizes.
	 */
	public function setup_environment() {
		
		$this->add_thumbnail_support();
		$this->add_image_sizes();

	}

	/**
	 * Ensure post thumbnail support is turned on
	 */
	private function add_thumbnail_support() {
		if ( ! current_theme_supports( 'post-thumbnails' ) ) {
			add_theme_support( 'post-thumbnails' );
		}
		add_post_type_support( 'recipe', 'thumbnail' );
	}

	/**
	 * Add RH Image sizes to WP
	 *
	 * @since 2.3
	 */
	private function add_image_sizes() {
		$recipe_single 		= rh_get_image_size( 'recipe_single' );
		$recipe_steps		= rh_get_image_size( 'recipe_steps' );
		$recipe_thumbnail	= rh_get_image_size( 'recipe_thumbnail' );

		add_image_size( 'rh-admin-column', 100, 100, true );
		add_image_size( 'recipe_single', $recipe_single['width'], $recipe_single['height'], $recipe_single['crop'] );
		add_image_size( 'recipe_steps', $recipe_steps['width'], $recipe_steps['height'], $recipe_steps['crop'] );
		add_image_size( 'recipe_thumbnail', $recipe_thumbnail['width'], $recipe_thumbnail['height'], $recipe_thumbnail['crop'] );
	}

	/** Helper functions ******************************************************/

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the template path.
	 *
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'recipe_hero_template_path', 'recipe-hero/' );
	}

}

endif;

/**
 * Returns the main instance of RecipeHero to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return RecipeHero (Class)
 */
function RH() {
	return RecipeHero::instance();
}

// Global for backwards compatibility.
$GLOBALS['recipe_hero'] = RH();