<?php
/**
 * Archive Recipe Template File
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @version   1.0.0
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

	<?php if ( apply_filters( 'recipe_hero_show_page_title', true ) ) : ?>

		<h1 class="page-title"><?php recipe_hero_page_title(); ?></h1>

	<?php endif; ?>

	<?php do_action( 'recipe_hero_archive_description' ); ?>

	<?php global $wp_query; ?>

	<?php if ( have_posts() ) { ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php recipe_hero_get_template_part( 'content', 'archive-recipe' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php
			/** recipe_hero_after_main_loop hook
			 *
			 * @hooked recipe_hero_output_loop_pagination - 10
			 */
			do_action( 'recipe_hero_after_main_loop' ); ?>

	<?php } else { ?>

		<?php recipe_hero_get_template( 'loop/no-recipes-found.php' ); ?>

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