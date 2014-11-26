<?php
/**
 * Display notices in admin.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RH_Admin_Notices' ) ) :

/**
 * RH_Admin_Notices Class
 */
class RH_Admin_Notices {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_print_styles', array( $this, 'add_notices' ) );
	}

	/**
	 * Add notices + styles if needed.
	 */
	public function add_notices() {

		if ( get_option( '_rh_needs_update' ) == 1 || get_option( '_rh_had_labels' ) == 1 ) {
			wp_enqueue_style( 'recipe-hero-activation', plugins_url( '../../assets/admin/css/activation.css', __FILE__ ), array(), RecipeHero::$version );
			add_action( 'admin_notices', array( $this, 'install_notice' ) );
		}

		$notices = get_option( 'recipe_hero_admin_notices', array() );

	}

	/**
	 * Show the install notices
	 */
	public function install_notice() {

		// If we need to update, include a message with the update button
		if ( get_option( '_rh_needs_update' ) == 1 ) {
			include( 'views/html-notice-update.php' );
		}

		// If they used the old settings labels, tell them to get the new plugin
		if ( get_option( '_rh_had_labels' ) == 1 ) {
			include( 'views/html-notice-labels.php' );
		}

	}

}

endif;

return new RH_Admin_Notices();