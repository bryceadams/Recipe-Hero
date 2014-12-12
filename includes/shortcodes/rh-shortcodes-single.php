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

if ( ! function_exists( 'recipe_hero_shortcode_single_display' ) ) {
	
	function recipe_hero_shortcode_single_display( $id ) {

		if ( ! $id ) {
		
			echo 'You need to include the ID attribute!';
		
		} else {

			// Enqueue Lightbox
			if ( get_option( 'recipe_hero_enable_lightbox' ) == '' || get_option( 'recipe_hero_enable_lightbox' ) == 'yes' ) {
				wp_enqueue_script( 'magnific' );
				wp_enqueue_script( 'rh-lightbox' );
				wp_enqueue_style( 'magnific-css' );
			}

			// We don't want recipe comments / reviews in a shortcode
			remove_action( 'recipe_hero_after_single_recipe', 'recipe_hero_output_single_comments', 10 );
		
			$args = array(
				'post_type' => 'recipe',
				'posts_per_page' => 1,
				'p' => $id
			);

			$the_query = new WP_Query( $args );
			
			if ( $the_query->have_posts() ) {

				while ( $the_query->have_posts() ) : $the_query->the_post();

					echo '<div class="recipe-hero">';
						echo recipe_hero_get_template_part( 'content', 'single-recipe' );
					echo '</div>';

				endwhile;

			wp_reset_postdata();

			} else {

			}

		}

	}

}

if ( ! function_exists( 'recipe_hero_shortcode_single' ) ) {
	
	function recipe_hero_shortcode_single( $atts ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'id' => '', // id of Recipe
				
			), $atts )
		);
		
		ob_start();
		recipe_hero_shortcode_single_display( $id );
		$data = ob_get_clean();
		return $data;

	}

}
add_shortcode( 'recipe', 'recipe_hero_shortcode_single' );