<?php
/**
 * Recipe Shortcode - Single Recipe
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Function to Display Single
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0.2
 */

if ( ! function_exists( 'recipe_hero_shortcode_archive_display' ) ) {
	
	function recipe_hero_shortcode_archive_display( $per_page, $orderby, $order, $ids, $course, $cuisine ) {
		
		$args = array(
				'post_type' 		=> 'recipe',
				'posts_per_page'	=> $per_page,
				'orderby'			=> $orderby,
				'order'				=> $order,
			);

		if ( $ids ) {
		
			$ids_explode = explode( ', ', $ids );
			$args['post__in'] = $ids_explode;

		}


		if ( $course || $cuisine ) {

			$args['tax_query'] = array(
				'relation'	=> 'AND', // @todo Make this an option? (AND or OR)
				$course ?
					array(
						'taxonomy' 	=> 'course',
						'field' 	=> 'slug',
						'terms' 	=> $course,
					) : false,
				$cuisine ?
					array(
						'taxonomy' 	=> 'cuisine',
						'field' 	=> 'slug',
						'terms' 	=> $cuisine,
					) : false,
			);
		}


		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ) : $the_query->the_post();

				echo '<div class="recipe-hero">';
					echo recipe_hero_get_template_part( 'content', 'archive-recipe' );
				echo '</div>';

			endwhile;

		wp_reset_postdata();

		} else {

			_e( 'No recipes have been found!', 'recipe-hero' );

		}

	}

}

if ( ! function_exists( 'recipe_hero_shortcode_archive' ) ) {
	
	function recipe_hero_shortcode_archive( $atts ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'per_page' 	=> 10, // how many recipes to show
				'orderby' 	=> 'date', // order recipes by
				'order' 	=> 'DESC', // order recipes in order
				'ids'		=> '', // specific IDs or recipes to display
				'course'	=> '', // recipe course to get recipes from
				'cuisine' 	=> '', // recipe cuisine to get recipes from
			), $atts )
		);
		
		ob_start();
		recipe_hero_shortcode_archive_display( $per_page, $orderby, $order, $ids, $course, $cuisine );
		$data = ob_get_clean();
		return $data;

	}

}
add_shortcode( 'recipes', 'recipe_hero_shortcode_archive' );