<?php
/**
 * Update to Recipe Hero 1.0.0
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @version   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Update Settings / Options
 */

// Old Settings
$rh_general_options 	= get_option( 'recipe_hero_general_options' );
$rh_style_options 		= get_option( 'recipe_hero_style_options' );
$rh_labels_options 		= get_option( 'recipe_hero_labels_options' );
$rh_other_options 		= get_option( 'recipe_hero_other_options' );

// Recipe Page
if ( isset( $rh_general_options['page_home'] ) ) {
	$rh_home_id = $rh_general_options['page_home'];
	update_option( 'recipe_hero_recipes_page_id', $rh_home_id );
}

// Single Image Size
if ( ! empty( $rh_general_options['image_size_main_width'] ) ) {
	$recipe_single_image_size['width'] = $rh_general_options['image_size_main_width'];
}
if ( ! empty( $rh_general_options['image_size_main_height'] ) ) {
	$recipe_single_image_size['height'] = $rh_general_options['image_size_main_height'];
}
if ( ! empty( $rh_general_options['image_size_main_crop'] ) ) {
	$recipe_single_image_size['crop'] = $rh_general_options['image_size_main_crop'];
}
update_option( 'recipe_single_image_size', $recipe_single_image_size );

// Steps Image Size
if ( ! empty( $rh_general_options['image_size_steps_width'] ) ) {
	$recipe_steps_image_size['width'] = $rh_general_options['image_size_steps_width'];
}
if ( ! empty( $rh_general_options['image_size_steps_height'] ) ) {
	$recipe_steps_image_size['height'] = $rh_general_options['image_size_steps_height'];
}
if ( ! empty( $rh_general_options['image_size_steps_crop'] ) ) {
	$recipe_steps_image_size['crop'] = $rh_general_options['image_size_steps_crop'];
}
update_option( 'recipe_steps_image_size', $recipe_steps_image_size );

// Lightbox Setting
if ( isset( $rh_style_options['disable_lightbox'] ) ) {
	update_option( 'recipe_hero_enable_lightbox', 'no' );
}

// If had labels before, update need labels option and save previous labels settings
$labels_array = array_filter( $rh_labels_options, 'strlen' );
if ( ! empty( $labels_array ) ) {
	update_option( '_rh_had_labels', 1 );
	if ( ! empty( $rh_labels_options['label_serves'] ) ) {
		update_option( 'rhl_serves', $rh_labels_options['label_serves'] );
	}
	if ( ! empty( $rh_labels_options['label_equipment'] ) ) {
		update_option( 'rhl_equipment', $rh_labels_options['label_equipment'] );
	}
	if ( ! empty( $rh_labels_options['label_prep'] ) ) {
		update_option( 'rhl_preptime', $rh_labels_options['label_prep'] );
	}
	if ( ! empty( $rh_labels_options['label_cook'] ) ) {
		update_option( 'rhl_cooktime', $rh_labels_options['label_cook'] );
	}
	if ( ! empty( $rh_labels_options['label_cuisine'] ) ) {
		update_option( 'rhl_cuisine', $rh_labels_options['label_cuisine'] );
	}
	if ( ! empty( $rh_labels_options['label_course'] ) ) {
		update_option( 'rhl_course', $rh_labels_options['label_course'] );
	}
}