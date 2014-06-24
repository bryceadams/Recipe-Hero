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
 * Plugin URI:        http://wprecipehero.com/
 * Description:       The last recipe plugin you'll ever need.
 * Version:           0.5.0
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
 * Define Some Cool Constants
 *----------------------------------------------------------------------------*/

// Plugin Folder Path
if( !defined( 'RECIPE_HERO_PLUGIN_DIR' ) ) {
	define( 'RECIPE_HERO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

// Template Folder Path
if( !defined( 'RECIPE_HERO_TEMPLATE_DIR' ) ) {
	define( 'RECIPE_HERO_TEMPLATE_DIR', plugin_dir_path( __FILE__ ) . 'templates/' );
}

// Define Current Plugin Version
if( ! defined( 'RECIPE_HERO_VERSION_NUMBER' ) ) {
	define( 'RECIPE_HERO_VERSION_NUMBER', '0.5.0' );
}

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
