<?php
/**
 * Setup menus in WP admin.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RH_Admin_Menus' ) ) :

/**
 * WC_Admin_Menus Class
 */
class RH_Admin_Menus {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		// Add menus
		add_action( 'admin_menu', array( $this, 'settings_menu' ), 50 );

		if ( apply_filters( 'recipe_hero_show_addons_page', true ) ) {
			//add_action( 'admin_menu', array( $this, 'addons_menu' ), 70 );
		}

		add_action( 'admin_head', array( $this, 'menu_highlight' ) );
	}

	/**
	 * Add menu item
	 */
	public function settings_menu() {
		$settings_page = add_submenu_page( 'edit.php?post_type=recipe', __( 'Recipe Hero Settings', 'recipe-hero' ),  '<span class="rh-settings-page">' . __( 'Settings', 'recipe-hero' ) . '</span>' , 'edit_posts', 'rh-settings', array( $this, 'settings_page' ) );

		add_action( 'load-' . $settings_page, array( $this, 'settings_page_init' ) );
	}

	/**
	 * Loads gateways and shipping methods into memory for use within settings.
	 */
	public function settings_page_init() {
		
	}

	/**
	 * Addons menu item
	 */
	public function addons_menu() {
		add_submenu_page( 'edit.php?post_type=recipe', __( 'WooCommerce Add-ons/Extensions', 'recipe-hero' ),  __( 'Add-ons', 'recipe-hero' ) , 'manage_woocommerce', 'wc-addons', array( $this, 'addons_page' ) );
	}

	/**
	 * Highlights the correct top level admin menu item for post type add screens.
	 *
	 * @return 	void
	 * @todo 	something better than this
	 */

	public function menu_highlight() {

	    global $current_screen;

	    if ( isset( $_GET['page'] ) && 'rh-settings' == $_GET['page'] )
	    {       
	        ?>
	        <script type="text/javascript">
	            jQuery(document).ready( function($) 
	            {
	                var reference = $('.rh-settings-page').parent().parent();

	                // add highlighting to our custom submenu
	                reference.addClass('current');
        
	            });     
	        </script>
	        <?php
	    }

	}

	/**
	 * Init the settings page
	 */
	public function settings_page() {
		RH_Admin_Settings::output();
	}

	/**
	 * Init the status page
	 */
	public function status_page() {
		RH_Admin_Status::output();
	}

	/**
	 * Init the addons page
	 */
	public function addons_page() {
		RH_Admin_Addons::output();
	}

}

endif;

return new RH_Admin_Menus();
