<?php
/**
 * Search Recipe Template File
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @todo 	  Options for Including Sidebar on left or right or excluding it completely (as some themes don't want it)
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php get_header(); ?>


	<?php
		/**
		 * recipe_hero_before_main_content hook
		 *
		 * @hooked 
		 */
		do_action( 'recipe_hero_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post();

			if ( get_post_type() == 'recipe' ) {

				recipe_hero_get_template_part( 'content', 'archive-recipe' );

			} else {

				get_template_part( 'content', get_post_format() );

			}

		endwhile; // end of the loop. ?>

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
