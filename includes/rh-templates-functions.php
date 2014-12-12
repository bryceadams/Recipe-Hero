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
 * Handle redirects before content is output - hooked into template_redirect so is_page works.
 *
 * @return void
 */
function rh_template_redirect() {

	// When default permalinks are enabled, redirect recipes page to post type archive url
	if ( ! empty( $_GET['page_id'] ) && get_option( 'permalink_structure' ) == "" && $_GET['page_id'] == rh_get_page_id( 'recipes' ) ) {
		wp_safe_redirect( get_post_type_archive_link('recipe') );
		exit;
	}

}
add_action( 'template_redirect', 'rh_template_redirect' );

/**
 * Include all the template parts
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0.2
 */

require_once( RH()->plugin_path() . '/includes/templates-parts/rh-templates-archive-functions.php' );
require_once( RH()->plugin_path() . '/includes/templates-parts/rh-templates-search-functions.php' );
require_once( RH()->plugin_path() . '/includes/templates-parts/rh-templates-sidebar-functions.php' );
require_once( RH()->plugin_path() . '/includes/templates-parts/rh-templates-single-functions.php' );
require_once( RH()->plugin_path() . '/includes/templates-parts/rh-templates-supports-functions.php' );
require_once( RH()->plugin_path() . '/includes/templates-parts/rh-templates-wrapper-functions.php' );