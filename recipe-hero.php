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
 * Version:           0.9.0
 * Author:            Captain Theme
 * Author URI:        http://captaintheme.com/
 * Text Domain:       recipe-hero
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * Made with the amazing: WordPress-Plugin-Boilerplate: v2.6.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Define Some Cool Constants & Globals
 *----------------------------------------------------------------------------*/

// Plugin Folder Path
if( ! defined( 'RECIPE_HERO_PLUGIN_DIR' ) ) {
	define( 'RECIPE_HERO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

// Template Folder Path
if( ! defined( 'RECIPE_HERO_TEMPLATE_DIR' ) ) {
	define( 'RECIPE_HERO_TEMPLATE_DIR', 'recipe-hero/' );
}

// Define Current Plugin Version
if( ! defined( 'RECIPE_HERO_VERSION_NUMBER' ) ) {
	define( 'RECIPE_HERO_VERSION_NUMBER', '0.9.0' );
}

$rh_general_options = get_option( 'recipe_hero_general_options' );
$rh_style_options = get_option( 'recipe_hero_style_options' );
$rh_labels_options = get_option( 'recipe_hero_labels_options' );
$rh_other_options = get_option( 'recipe_hero_other_options' );

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-recipe-hero.php' );

register_activation_hook( __FILE__, array( 'Recipe_Hero', 'activate' ) );

add_action( 'plugins_loaded', array( 'Recipe_Hero', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-recipe-hero-admin.php' );
	add_action( 'plugins_loaded', array( 'Recipe_Hero_Admin', 'get_instance' ) );

}


