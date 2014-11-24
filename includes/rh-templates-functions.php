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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Include all the template parts
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/templates-parts/rh-templates-archive-functions.php' );
require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/templates-parts/rh-templates-search-functions.php' );
require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/templates-parts/rh-templates-sidebar-functions.php' );
require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/templates-parts/rh-templates-single-functions.php' );
require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/templates-parts/rh-templates-supports-functions.php' );
require_once( RECIPE_HERO_PLUGIN_DIR . 'includes/templates-parts/rh-templates-wrapper-functions.php' );