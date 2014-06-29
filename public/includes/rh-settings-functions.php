<?php
/**
 * Functions that run because of the Recipe Hero Core Settings
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

/**
 * Disable Styles
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 */

if ( ! function_exists( 'recipe_hero_option_disable_styles' ) ) {
	
	function recipe_hero_option_disable_styles() {

		if ( recipe_hero_get_option( 'rh-disable-styles', 'recipe-hero-options' ) ) {
			add_filter( 'recipe_hero_enqueue_styles', '__return_false' );
		}

	}

}
add_action( 'init', 'recipe_hero_option_disable_styles', 9999 );

/**
 * Disable Lightbox
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 */

if ( ! function_exists( 'recipe_hero_option_disable_lightbox' ) ) {

	function recipe_hero_option_disable_lightbox() {

		if ( ! recipe_hero_get_option( 'rh-disable-lightbox', 'recipe-hero-options' ) ) {

			if ( ( get_post_type() == 'recipe' ) && is_single() ) {

				wp_enqueue_script( 'magnific' );
				wp_enqueue_style( 'magnific-css' );
				
			}

		}

	}

}
add_action( 'wp_enqueue_scripts', 'recipe_hero_option_disable_lightbox', 9999 );

/**
 * Specified Recipe Home Page - Hide Comments (if turned on)
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 */

if ( ! function_exists( 'recipe_hero_override_comments_open' ) ) {
	
	function recipe_hero_override_comments_open( $close ) {

		// Variables
		global $post;
		$rh_home_id = recipe_hero_get_option( 'rh-recipe-page-display', 'recipe-hero-options' );

	    if ( isset( $rh_home_id ) ) {
			if ( $post->ID == $rh_home_id ) {
				$close = false;
			}
		}
	    return $close;
	}

}
add_filter('comments_open', 'recipe_hero_override_comments_open', 1000);

/**
 * Basic Styling Options
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 * @todo 	  Make rules smarter - if 'px' needed but not given, append it, etc.
 */

if ( ! function_exists( 'recipe_hero_option_styles' ) ) {

	function recipe_hero_option_styles() {

		$padding = recipe_hero_get_option( 'rh-styling-option-padding', 'recipe-hero-options' );
		$width = recipe_hero_get_option( 'rh-styling-option-width', 'recipe-hero-options' );
		$center = recipe_hero_get_option( 'rh-styling-option-center', 'recipe-hero-options' ); ?>

		<style type="text/css">

			<?php if ( $padding ) { ?>
				

				article.recipe,
				.recipe-archive-tax-header,
				.single-recipe #comments,
				.recipe-search article,
				.recipe-search header.page-header {
					padding: <?php echo $padding; ?>;
				}

			<?php } ?>

			<?php if ( $width ) { ?>

				article {
					width: <?php echo $width; ?>;
				}

			<?php } ?>

			<?php if ( $center ) { ?>

				article {
					margin: 0 auto;
				}

			<?php } ?>

		</style>

	<?php }

}
add_action( 'wp_head', 'recipe_hero_option_styles' );