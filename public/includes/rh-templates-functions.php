<?php
/**
 * General Template-related Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

/**
 * Include all the template parts
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

require_once( RECIPE_HERO_PLUGIN_DIR . 'public/includes/templates-parts/rh-templates-parts-display.php' );



if ( ! function_exists( 'recipe_hero_output_content_wrapper' ) ) {

	/**
	 * Output the start of the page wrapper.
	 *
	 * @access public
	 * @return void
	 */
	function recipe_hero_output_content_wrapper() {

		recipe_hero_get_template( 'global/wrapper-start.php' );
	}
}
if ( ! function_exists( 'recipe_hero_content_wrapper_end' ) ) {

	/**
	 * Output the end of the page wrapper.
	 *
	 * @access public
	 * @return void
	 */
	function recipe_hero_output_content_wrapper_end() {
		recipe_hero_get_template( 'global/wrapper-end.php' );
	}
}

if ( ! function_exists( 'recipe_hero_get_sidebar' ) ) {

	/**
	 * Get the shop sidebar template.
	 *
	 * @access public
	 * @return void
	 */
	function recipe_hero_get_sidebar() {
		recipe_hero_get_template( 'global/sidebar.php' );
	}
}
