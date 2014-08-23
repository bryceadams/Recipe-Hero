<?php
/**
 * Recepe Schema Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Prep Time Schema
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 * @todo 	  Would be better to use some function or class for getting the time as it needs to be ISO8601 time format
 */

if ( ! function_exists( 'recipe_hero_schema_prep_time' ) ) {
	
	function recipe_hero_schema_prep_time() {

		// Vars
		global $post;
		$prep_time 	      = recipe_hero_convert_minute_hour ( get_post_meta ( $post->ID, '_recipe_hero_detail_prep_time', true ) );
		$prep_time_alt    = strtoupper( str_replace( array( ' ', '-', ',' ), array( '' ), $prep_time ) );

		$prep_time_schema = 'PT' . $prep_time_alt;

		return $prep_time_schema;

	}

}

/**
 * Cook Time Schema
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 * @todo 	  Would be better to use some function or class for getting the time as it needs to be ISO8601 time format
 */

if ( ! function_exists( 'recipe_hero_schema_cook_time' ) ) {

	function recipe_hero_schema_cook_time() {

		// Vars
		global $post;
		$cook_time 	       = recipe_hero_convert_minute_hour ( get_post_meta ( $post->ID, '_recipe_hero_detail_cook_time', true ) );
		$cook_time_alt     = strtoupper( str_replace( array( ' ', '-', ',' ), array( '' ), $cook_time ) );

		$cook_time_schema  = 'PT' . $cook_time_alt;

		return $cook_time_schema;

	}

}

/**
 * Total Time Schema
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 * @todo 	  Would be better to use some function or class for getting the time as it needs to be ISO8601 time format
 */

if ( ! function_exists( 'recipe_hero_schema_total_time' ) ) {

	function recipe_hero_schema_total_time() {

		// Vars
		global $post;
		$total_time 	      = recipe_hero_convert_minute_hour ( recipe_hero_calc_total_cook_time() );
		$total_time_alt 	  = strtoupper( str_replace( array( ' ', '-', ',' ), array( '' ), $total_time ) );

		$total_time_schema 	  = 'PT' . $total_time_alt;

		return $total_time_schema;

	}

}