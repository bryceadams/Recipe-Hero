<?php
/**
 * Recipe Sidebar Template Display Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Recipe Sidebar
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_get_sidebar' ) ) {

	function recipe_hero_get_sidebar() {

		recipe_hero_get_template( 'global/sidebar.php' );

	}
	
}