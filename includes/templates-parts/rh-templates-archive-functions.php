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
 * @since 	  1.0.0
 */

if ( ! function_exists( 'recipe_hero_output_loop_pagination' ) ) {

	function recipe_hero_output_loop_pagination() {

		recipe_hero_get_template( 'loop/pagination.php' );

	}

}

/**
 * Get a recipes page title on archives
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0.0
 */

if ( ! function_exists( 'recipe_hero_page_title' ) ) {

	function recipe_hero_page_title( $echo = true ) {

		if ( is_search() ) {

			$page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'recipe-hero' ), get_search_query() );

			if ( get_query_var( 'paged' ) ) {
				$page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'recipe-hero' ), get_query_var( 'paged' ) );
			}

		} elseif ( is_tax() ) {

			$page_title = single_term_title( "", false );

		} else {

			$recipe_page_id = rh_get_page_id( 'recipes' );
			$page_title   	= get_the_title( $recipe_page_id );

		}

		$page_title = apply_filters( 'recipe_hero_page_title', $page_title );

		if ( $echo ) {
	    	echo $page_title;
		} else {
	    	return $page_title;
		}

	}

}

/**
 * Show a recipe page description on recipe archives
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0.0
 */

if ( ! function_exists( 'recipe_hero_recipes_archive_description' ) ) {

	function recipe_hero_recipes_archive_description() {

		if ( is_post_type_archive( 'recipe' ) && get_query_var( 'paged' ) == 0 ) {
			$recipe_page   = get_post( rh_get_page_id( 'recipes' ) );
			if ( $recipe_page ) {
				$description = wpautop( do_shortcode( $recipe_page->post_content ) );
				if ( $description ) {
					echo '<div class="page-description">' . $description . '</div>';
				}
			}
		}

	}

}

/**
 * Show a recipe taxonomy description on recipe tax archives
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0.0
 */

if ( ! function_exists( 'recipe_hero_taxonomy_archive_description' ) ) {

	function recipe_hero_taxonomy_archive_description() {

		if ( is_tax( array( 'cuisine', 'course' ) ) && get_query_var( 'paged' ) == 0 ) {
			$description = wpautop( do_shortcode( term_description() ) );
			if ( $description ) {
				echo '<div class="term-description">' . $description . '</div>';
			}
		}

	}

}