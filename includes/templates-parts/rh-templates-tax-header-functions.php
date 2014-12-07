<?php
/**
 * Recipe Archive Taxonomy Header Titles
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
 * Recipe Archive Titles (Cat / Tax etc.)
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.9.0
 */		

if ( ! function_exists( 'recipe_hero_archive_tax_title' ) ) {

	function recipe_hero_archive_tax_title() {

		if ( is_tax( 'cuisine' ) ) {

			$cuisine_text = apply_filters( 'rh_label_cuisine', __( 'Cuisine', 'recipe-hero' ) );

			echo '<div class="recipe-archive-tax-header">';
			echo '<h1 class="archive-title">';
			echo single_term_title( $cuisine_text . ': ' );
			echo '</h1>';
		
		} elseif ( is_tax( 'course' ) ) {

			$course_text = apply_filters( 'rh_label_course', __( 'Course', 'recipe-hero' ) );
			
			echo '<div class="recipe-archive-tax-header">';
			echo '<h1 class="archive-title">';
			echo single_term_title( $course_text . ': ' );
			echo '</h1>';
		
		} else { }

	}

}

if ( ! function_exists( 'recipe_hero_archive_tax_desc' ) ) {

	function recipe_hero_archive_tax_desc() {

		if ( is_tax() ) {

			$term_description = term_description();

			if ( ! empty( $term_description ) ) {
				echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $term_description . '</div>' );
			}

			echo '</div><hr />';

		}
	
	}

}