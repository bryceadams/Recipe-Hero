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


/**
 * Recipe Display Sidebar / Full Width
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

function recipe_hero_display_sidebar_right() {

	$sidebar_setting = recipe_hero_get_option( 'rh-sidebar-settings', 'recipe-hero-options' );

	if ( $sidebar_setting == 'sidebar' ) {
		echo recipe_hero_get_sidebar();
	} else {
		echo '<style type="text/css">#content { width: 100%; }</style>';
	}

}

// If Sidebar, Add commonly used 'has-right-sidebar' to Body Classes
function recipe_hero_display_sidebar_body_class( $classes ) {
	
	// Variables
	global $post;
	$sidebar_setting = recipe_hero_get_option( 'rh-sidebar-settings', 'recipe-hero-options' );

	if ( $sidebar_setting == 'sidebar' && get_post_type() == 'recipe' ) {
		$classes[] = 'has-right-sidebar';
		return $classes;
	}

}
add_filter( 'body_class','recipe_hero_display_sidebar_body_class' );