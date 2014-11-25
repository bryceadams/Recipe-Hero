<?php
/**
 * Recipe Hero Admin Functions
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
 * Output admin fields.
 *
 * Loops though the recipe hero options array and outputs each field.
 *
 * @param array $options Opens array to output
 */
function recipe_hero_admin_fields( $options ) {
	if ( ! class_exists( 'RH_Admin_Settings' ) ) {
		include 'class-rh-admin-settings.php';
	}

	RH_Admin_Settings::output_fields( $options );
}

/**
 * Update all settings which are passed.
 *
 * @param array $options
 * @return void
 */
function recipe_hero_update_options( $options ) {
	if ( ! class_exists( 'RH_Admin_Settings' ) ) {
		include 'class-rh-admin-settings.php';
	}

	RH_Admin_Settings::save_fields( $options );
}

/**
 * Get a setting from the settings API.
 *
 * @param mixed $option_name
 * @return string
 */
function recipe_hero_settings_get_option( $option_name, $default = '' ) {
	if ( ! class_exists( 'RH_Admin_Settings' ) ) {
		include 'class-rh-admin-settings.php';
	}

	return RH_Admin_Settings::get_option( $option_name, $default );
}