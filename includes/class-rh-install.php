<?php
/**
 * Installation related functions and actions.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RH_Install' ) ) :

/**
 * RH_Install Class
 */
class RH_Install {

	public function __construct() {
		// Run this on activation.
		register_activation_hook( RH_PLUGIN_FILE, array( $this, 'install' ) );

		// Hooks
		add_action( 'admin_init', array( $this, 'install_actions' ) );
		add_action( 'admin_init', array( $this, 'check_version' ), 5 );
		add_filter( 'plugin_action_links_' . RH_PLUGIN_BASENAME, array( $this, 'plugin_action_links' ) );
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );

		add_action( 'plugins_loaded', array( $this, 'rating_reminder' ) );
	}

	/**
	 * check_version function.
	 *
	 * @return void
	 */
	public function check_version() {
		if ( ! defined( 'IFRAME_REQUEST' ) && ( get_option( 'recipe_hero_version' ) != RecipeHero::$version || get_option( 'recipe_hero_db_version' ) != RecipeHero::$version ) ) {
			$this->install();

			do_action( 'recipe_hero_updated' );
		}
	}

	/**
	 * Install actions such as installing pages when a button is clicked.
	 */
	public function install_actions() {
		
		// If updates are needed and the button is pressed, do it
		if ( ! empty( $_GET['do_update_recipe_hero'] ) ) {

			$this->update();

			// Update complete
			delete_option( '_rh_needs_update' );
			delete_transient( '_rh_activation_redirect' );

			// What's new redirect
			wp_redirect( admin_url( 'index.php?page=recipe-hero-about&recipe-hero-updated=true' ) );
			exit;

		}

		// If understood labels notice, delete it
		if ( ! empty( $_GET['dismiss_rh_labels_notice'] ) ) {
			delete_option( '_rh_had_labels' );
		}

	}


	/**
	 * Install Recipe Hero
	 * @todo next DB updater, add to version compare: && null !== $current_db_version )
	 */
	public function install() {

		$this->create_options();

		// Register post types
		include_once( 'class-rh-post-types.php' );
		RH_Post_types::register_post_types();
		RH_Post_types::register_taxonomies();

		// Queue upgrades
		$current_version    = get_option( 'recipe_hero_version', null );
		$current_db_version = get_option( 'recipe_hero_db_version', null );

		if ( version_compare( $current_db_version, '1.0.0', '<' ) ) {
			update_option( '_rh_needs_update', 1 );
		} else {
			update_option( 'recipe_hero_db_version', RecipeHero::$version );
		}

		// Update version
		update_option( 'recipe_hero_version', RecipeHero::$version );

		// Rating Reminder
		self::install_date();

		// Flush rules after install
		flush_rewrite_rules();

	}

	/**
	 * Handle updates
	 */
	public function update() {

		// Do updates
		$current_db_version = get_option( 'recipe_hero_db_version' );

		if ( version_compare( $current_db_version, '1.0', '<' ) ) {

			include( 'updates/recipe-hero-update-1.0.php' );
			update_option( 'recipe_hero_db_version', '1.0' );

		}

		update_option( 'recipe_hero_db_version', RecipeHero::$version );

	}

	/**
	 * Default options
	 *
	 * Sets up the default options used on the settings page
	 *
	 * @return void
	 */
	public function create_options() {
		// Include settings so that we can run through defaults
		include_once( 'admin/class-rh-admin-settings.php' );

		$settings = RH_Admin_Settings::get_settings_pages();

		foreach ( $settings as $section ) {
			if ( ! method_exists( $section, 'get_settings' ) ) {
				continue;
			}

			foreach ( $section->get_settings() as $value ) {
				if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
					$autoload = isset( $value['autoload'] ) ? (bool) $value['autoload'] : true;
					add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
				}
			}

		}
	}

	/**
	 * Show action links on the plugin screen.
	 *
	 * @param	mixed $links Plugin Action links
	 * @return	array
	 */
	public function plugin_action_links( $links ) {
		$action_links = array(
			'settings'	=>	'<a href="' . admin_url( 'edit.php?post_type=recipe&page=rh-settings' ) . '" title="' . esc_attr( __( 'View Recipe Hero Settings', 'recipe-hero' ) ) . '">' . __( 'Settings', 'recipe-hero' ) . '</a>',
		);

		return array_merge( $action_links, $links );
	}

	/**
	 * Show row meta on the plugin screen.
	 *
	 * @param	mixed $links Plugin Row Meta
	 * @param	mixed $file  Plugin Base file
	 * @return	array
	 */
	public function plugin_row_meta( $links, $file ) {
		if ( $file == RH_PLUGIN_BASENAME ) {
			$row_meta = array(
				'docs'		=>	'<a href="' . esc_url( apply_filters( 'recipe_hero_docs_url', 'http://recipehero.in/docs/' ) ) . '" title="' . esc_attr( __( 'View Recipe Hero Documentation', 'recipe-hero' ) ) . '">' . __( 'Docs', 'recipe-hero' ) . '</a>',
				'support'	=>	'<a href="' . esc_url( apply_filters( 'recipe_hero_support_url', 'http://recipehero.in/support/' ) ) . '" title="' . esc_attr( __( 'Get Support for Recipe Hero', 'recipe-hero' ) ) . '">' . __( 'Support', 'recipe-hero' ) . '</a>',
			);

			return array_merge( $links, $row_meta );
		}

		return (array) $links;
	}

	/**
	 * Rating Reminder (7 days after install)
	 */

	public function rating_reminder() {

		// Admin notice hide catch
		add_action( 'admin_init', array( $this, 'catch_hide_notice' ) );

		// Is admin notice hidden?
		$current_user = wp_get_current_user();
		$hide_notice  = get_user_meta( $current_user->ID, 'recipe_hero_hide_rating_reminder', true );

		if ( current_user_can( 'install_plugins' ) && $hide_notice == '' ) {
			// Get installation date
			$datetime_install = $this->get_install_date();
			$datetime_past    = new DateTime( '-7 days' );

			if ( $datetime_past >= $datetime_install ) {
				// 10 or more days ago, show admin notice
				add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
			}
		}

	}

	/**
	 * Install Date
	 */

	private static function install_date() {

		$datetime_now = new DateTime();
		$date_string  = $datetime_now->format( 'Y-m-d' );
		update_option( 'recipe_hero_install_date', $date_string );

		return $date_string;

	}

	/**
	 * Get Install Date
	 */

	private function get_install_date() {

		$date_string = get_option( 'recipe_hero_install_date', '' );
		if ( $date_string == '' ) {
			// There is no install date, plugin was installed before version 1.2.0. Add it now.
			$date_string = self::install_date();
		}

		return new DateTime( $date_string );

	}

	/**
	 * Get the admin query string array
	 */

	private function get_admin_querystring_array() {
		parse_str( $_SERVER['QUERY_STRING'], $params );

		return $params;
	}

	/**
	 * Catch / Hide Notice
	 */

	public function catch_hide_notice() {
		if ( isset( $_GET['recipe_hero_hide_rating_reminder'] ) && current_user_can( 'install_plugins' ) ) {
			// Add user meta
			global $current_user;
			add_user_meta( $current_user->ID, 'recipe_hero_hide_rating_reminder', '1', true );

			// Build redirect URL
			$query_params = $this->get_admin_querystring_array();
			unset( $query_params['recipe_hero_hide_rating_reminder'] );
			$query_string = http_build_query( $query_params );
			if ( $query_string != '' ) {
				$query_string = '?' . $query_string;
			}

			$redirect_url = 'http';
			if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) {
				$redirect_url .= 's';
			}
			$redirect_url .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . $query_string;

			// Redirect
			wp_redirect( $redirect_url );
			exit;
		}
	}

	/**
	 * Display the admin notice
	 */

	public function display_admin_notice() {

		$query_params = $this->get_admin_querystring_array();
		$query_string = '?' . http_build_query( array_merge( $query_params, array( 'recipe_hero_hide_rating_reminder' => '1' ) ) );

		echo '<div class="updated"><p>';
		printf( __( 'You\'ve been using <b>Recipe Hero</b> for some time now, would you please consider reviewing on wordpress.org? :) <br /><br /> <a href="%s" target="_blank">Yes, take me there!</a> - <a href="%s">I\'ve already done this!</a>', 'recipe-hero' ), 'http://wordpress.org/support/view/plugin-reviews/recipe-hero', $query_string );
		echo "</p></div>";

	}

}

endif;

return new RH_Install();