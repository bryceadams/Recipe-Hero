<?php
/**
 * Image Sizes
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
 * Add Image Sizes based on defaults and settings
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.9.0
 */

global $rh_general_options;

if ( ! empty( $rh_general_options['image_size_main_width'] ) ) {
	$is_main_width = $rh_general_options['image_size_main_width'];
} else {
	$is_main_width = 700;
}

if ( ! empty( $rh_general_options['image_size_main_height'] ) ) {
	$is_main_height = $rh_general_options['image_size_main_height'];
} else {
	$is_main_height = 9999;
}

if ( isset( $rh_general_options['image_size_main_crop'] ) ) {
	$is_main_crop = true;
} else {
	$is_main_crop = false;
}

if ( ! empty( $rh_general_options['image_size_steps_width'] ) ) {
	$is_steps_width = $rh_general_options['image_size_steps_width'];
} else {
	$is_steps_width = 650;
}

if ( ! empty( $rh_general_options['image_size_steps_height'] ) ) {
	$is_steps_height = $rh_general_options['image_size_steps_height'];
} else {
	$is_steps_height = 9999;
}

if ( isset( $rh_general_options['image_size_steps_crop'] ) ) {
	$is_steps_crop = true;
} else {
	$is_steps_crop = false;
}

add_image_size( 'rh-admin-column', 100, 100, true );
add_image_size( 'rh-recipe-single', $is_main_width, $is_main_height, $is_main_crop );
add_image_size( 'rh-recipe-steps', $is_steps_width, $is_steps_height, $is_steps_crop );
