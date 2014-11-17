<?php
/**
 * Shortcodes Functions
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

/**
 * Include all the shortcodes
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.1
 */

require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/shortcodes/rh-shortcodes-single.php' );
require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/shortcodes/rh-shortcodes-archive.php' );


/**
 * Remove [recipe] shortcode from JetPack to stop conflicts with our [recipe] shortcode
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0.0
 */

function recipe_hero_remove_jetpack_shortcode( $shortcodes ) {
    $jetpack_shortcodes_dir = WP_CONTENT_DIR . '/plugins/jetpack/modules/shortcodes/';
     
    $shortcodes_to_unload = array( 'recipe.php' );
 
    foreach ( $shortcodes_to_unload as $shortcode ) {
        if ( $key = array_search( $jetpack_shortcodes_dir . $shortcode, $shortcodes ) ) {
            unset( $shortcodes[$key] );
        }
    }
         
    return $shortcodes;
}
// Check if JetPack is active
if ( in_array( 'jetpack/jetpack.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_filter( 'jetpack_shortcodes_to_include', 'recipe_hero_remove_jetpack_shortcode' );
}