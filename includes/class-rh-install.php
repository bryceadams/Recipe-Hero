<?php
/**
 * Installation related functions and actions.
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

if ( ! class_exists( 'RH_Install' ) ) :

/**
 * WC_Install Class
 */
class RH_Install {

	public function __construct() {
		// Run this on activation.
		register_activation_hook( RH_PLUGIN_FILE, array( $this, 'install' ) );

		// Hooks
		add_action( 'admin_init', array( $this, 'check_version' ), 5 );
		add_filter( 'plugin_action_links_' . RH_PLUGIN_BASENAME, array( $this, 'plugin_action_links' ) );
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
	}

	/**
	 * check_version function.
	 *
	 * @return void
	 */
	public function check_version() {
		if ( ! defined( 'IFRAME_REQUEST' ) && ( get_option( 'recipe_hero_version' ) != RecipeHero::$version ) ) {
			$this->install();

			do_action( 'recipe_hero_updated' );
		}
	}


	/**
	 * Install Recipe Hero
	 */
	public function install() {

		// Register post types
		include_once( 'class-rh-post-types.php' );
		RH_Post_types::register_post_types();
		RH_Post_types::register_taxonomies();

		// Update version
		update_option( 'recipe_hero_version', RecipeHero::$version );

		// Flush rules after install
		flush_rewrite_rules();

	}

	/**
	 * Show action links on the plugin screen.
	 *
	 * @param	mixed $links Plugin Action links
	 * @return	array
	 */
	public function plugin_action_links( $links ) {
		$action_links = array(
			'settings'	=>	'<a href="' . admin_url( 'edit.php?post_type=recipe&page=recipe_hero_general_options' ) . '" title="' . esc_attr( __( 'View Recipe Hero Settings', 'recipe-hero' ) ) . '">' . __( 'Settings', 'recipe-hero' ) . '</a>',
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

}

endif;

return new RH_Install();