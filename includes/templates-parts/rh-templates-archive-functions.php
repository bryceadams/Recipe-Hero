<?php
/**
 * Recipe Archive Template Display Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Recipe Title
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_archive_title' ) ) {

	function recipe_hero_output_archive_title() {

		recipe_hero_get_template( 'archive/title.php' );

	}
	
}

/**
 * Recipe Meta: Author & Date
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 * @todo 	  Make 'By' fitlerable / an option
 */

if ( ! function_exists( 'recipe_hero_output_archive_meta' ) ) {

	function recipe_hero_output_archive_meta() {

		recipe_hero_get_template( 'archive/meta.php' );

	}

}

/**
 * Recipe Featured Image Photo
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_archive_photo' ) ) {

	function recipe_hero_output_archive_photo() {

		recipe_hero_get_template( 'archive/photo.php' );

	}

}

/**
 * Recipe Cuisine / Course
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 * @todo 	  Make 'By' fitlerable / an option
 */

if ( ! function_exists( 'recipe_hero_output_archive_tax' ) ) {

	function recipe_hero_output_archive_tax() {

		recipe_hero_get_template( 'archive/category.php' );

	}

}

/**
 * Recipe Details / Information
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_archive_details' ) ) {

	function recipe_hero_output_archive_details() {

		recipe_hero_get_template( 'archive/details.php' );
		
	}

}

/**
 * Recipe Content / Description
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_archive_description' ) ) {

	function recipe_hero_output_archive_description() {

		recipe_hero_get_template( 'archive/description.php' );

	}

}

/**
 * Recipe Archive Loop - Pagination
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_loop_pagination' ) ) {

	function recipe_hero_output_loop_pagination() {

		recipe_hero_get_template( 'loop/pagination.php' );

	}

}

