<?php
/**
 * Archive Recipe Template File
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $rh_general_options; ?>

<?php get_header(); ?>

	<?php
		/**
		 * recipe_hero_before_main_content hook
		 *
		 * @hooked 
		 */
		do_action( 'recipe_hero_before_main_content' );
	?>

	<?php

		// Variables
		if ( isset( $rh_general_options['per_page'] ) ) {
	
			$recipes_per_page = $rh_general_options['per_page'];

		} else {

			$recipes_per_page = 10;
		}

		$args = array(
				'post_type' => 'recipe',
				'posts_per_page' => $recipes_per_page,
			);

		$the_query = new WP_Query( $args );
		
	?>

	<?php if ( $the_query->have_posts() ) { ?>

		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<?php recipe_hero_get_template_part( 'content', 'archive-recipe' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php wp_reset_postdata(); ?>

	<?php } else { ?>

	  	<p>
	  		<?php _e( 'Sorry, there are no recipes to show!', 'recipe-hero' ); ?>
	  		<?php if ( current_user_can( 'publish_posts' ) ) {
	  			echo '<a href="' . admin_url( '/post-new.php?post_type=recipe' ) . '">';
	  			_e( 'Add Your First Recipe!', 'recipe-hero' );
	  			echo '</a>';
	  		} else {
	  			_e( 'We have some coming soon though!', 'recipe-hero' );
	  		} ?>
	  	</p>

	<?php } ?>

	<?php
		/**
		 * recipe_hero_after_main_content hook
		 *
		 * @hooked recipe_hero_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'recipe_hero_after_main_content' );
	?>

	<?php
		/**
		 * recipe_hero_sidebar hook
		 *
		 * @hooked recipe_hero_get_sidebar - 10
		 */
		do_action( 'recipe_hero_sidebar_right' );
	?>

<?php get_footer(); ?>