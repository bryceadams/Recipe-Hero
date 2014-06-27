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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php get_header(); ?>

	<?php

		$args = array(
				'post_type' => 'recipe',
			);

		$the_query = new WP_Query( $args );

	?>

	<?php
		/**
		 * recipe_hero_before_main_content hook
		 *
		 * @hooked 
		 */
		do_action( 'recipe_hero_before_main_content' );
	?>

		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<?php
			//	if ( $counter % $columns == 1 ) {
					//echo '<div class="grid">';
			//	}
			?>

			<?php recipe_hero_get_template_part( 'content', 'archive-recipe' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * recipe_hero_after_main_content hook
		 *
		 * @hooked recipe_hero_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'recipe_hero_after_main_content' );
	?>

<?php get_footer(); ?>
