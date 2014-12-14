<?php
/**
 * Runs on Uninstall of Recipe Hero (deleted through WordPress admin)
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.3
 */

if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$options = array(
	'recipe_hero_recipes_page_id',
	'recipe_hero_recipe_order',
	'recipe_hero_enable_review_rating',
	'recipe_single_image_size',
	'recipe_steps_image_size',
	'recipe_thumbnail_image_size',
	'recipe_hero_enable_lightbox',
);

foreach ( $options as $option ) {
	if ( get_option( $option ) ) {
		delete_option( $option );
	}
}