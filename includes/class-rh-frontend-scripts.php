<?php
/**
 * Functions to load front-end scripts / styles
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Recipe_Hero_Frontend_Scripts' ) ) {

	class Recipe_Hero_Frontend_Scripts {

		/**
		 * Constructor
		 */
		public function __construct () {
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
			add_filter( 'recipe_hero_enqueue_styles', array( $this, 'backwards_compat' ) );
		}

		/**
		 * Get styles for the frontend
		 * @return array
		 */
		public static function get_styles() {
			return apply_filters( 'recipe_hero_enqueue_styles', array(
				'rh-layout' => array(
					'src'     => RH()->plugin_url() . '/assets/frontend/css/gridism.css',
					'deps'    => '',
					'version' => RecipeHero::$version,
					'media'   => 'all'
				),
				'rh-general' => array(
					'src'     => RH()->plugin_url() . '/assets/frontend/css/recipe-hero.css',
					'deps'    => '',
					'version' => RecipeHero::$version,
					'media'   => 'all'
				),
			) );
		}

		/**
		 * Register/queue frontend scripts.
		 *
		 * @access public
		 * @return void
		 */
		public function load_scripts() {
			global $post, $wp;

			// Register all scripts/styles for later use
			wp_register_script( 'rh-scripts', RH()->plugin_url() . '/assets/frontend/js/rh-scripts.js', array( 'jquery' ), RecipeHero::$version, true );
			
			wp_register_script( 'magnific', RH()->plugin_url() . '/assets/frontend/js/jquery.magnific-popup.min.js', array( 'jquery' ), RecipeHero::$version, true );
			wp_register_script( 'rh-lightbox', RH()->plugin_url() . '/assets/frontend/js/rh-lightbox.js', array( 'jquery', 'magnific' ), RecipeHero::$version, true );
			wp_register_style( 'magnific-css', RH()->plugin_url() . '/assets/frontend/css/magnific-popup.css', RecipeHero::$version, true );

			wp_register_style( 'rh-general-rtl', RH()->plugin_url() . '/assets/frontend/css/recipe-hero-rtl.css', RecipeHero::$version, true );

			if ( is_rtl() ) {
				wp_enqueue_style( 'rh-general-rtl' );
			}

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'rh-scripts' );

			// CSS Styles
			wp_enqueue_style( 'dashicons' );
			$enqueue_styles = $this->get_styles();

			if ( $enqueue_styles ) {
				foreach ( $enqueue_styles as $handle => $args ) {
					wp_enqueue_style( $handle, $args['src'], $args['deps'], $args['version'], $args['media'] );
				}
			}
		}


		/**
		 * Provide backwards compat for old constant
		 * @param  array $styles
		 * @return array
		 * @depreciated 0.8.0
		 */
		public function backwards_compat( $styles ) {
			if ( defined( 'RECIPE_HERO_USE_CSS' ) ) {
				if ( ! RECIPE_HERO_USE_CSS ) {
					return false;
				}
			}

			return $styles;
		}

	}

}

new Recipe_Hero_Frontend_Scripts();