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
 * @since 	  0.6.0
 */

function recipe_hero_option_disable_styles() {

	if ( recipe_hero_get_option( 'rh-disable-styles', 'recipe-hero-options' ) ) {
		add_filter( 'recipe_hero_enqueue_styles', '__return_false' );
	}

}
add_action( 'init', 'recipe_hero_option_disable_styles', 9999 );

/**
 * Disable Lightbox
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.6.0
 */

function recipe_hero_option_disable_lightbox() {

	if ( ! recipe_hero_get_option( 'rh-disable-lightbox', 'recipe-hero-options' ) ) {

		if ( ( get_post_type() == 'recipe' ) && is_single() ) {

			wp_enqueue_script( 'magnific' );
			wp_enqueue_style( 'magnific-css' );
			
		}

	}

}
add_action( 'wp_enqueue_scripts', 'recipe_hero_option_disable_lightbox', 9999 );