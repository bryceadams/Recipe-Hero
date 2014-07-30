<?php
/**
 * Runs on Uninstall of Recipe Hero (deleted through WordPress admin)
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

$other_options = get_option( 'recipe_hero_other_options' );

if ( isset ( $other_options['delete_options'] ) ) {

	// Delete Recipe Hero Options
	delete_option( 'recipe_hero_general_options' );
	delete_option( 'recipe_hero_style_options' );
	delete_option( 'recipe_hero_labels_options' );
	delete_option( 'recipe_hero_other_options' );

}