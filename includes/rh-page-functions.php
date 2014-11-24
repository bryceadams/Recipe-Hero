<?php
/**
 * Include and setup custom metaboxes and fields.
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
 * Retrieve page ids - currently just for 'recipes' page, returns -1 if no page is found
 *
 * @param string $page
 * @return int
 */
function rh_get_page_id( $page ) {

	$page = apply_filters( 'recipe_hero_get_' . $page . '_page_id', get_option( 'recipe_hero_' . $page . '_page_id' ) );

	return $page ? absint( $page ) : -1;
}