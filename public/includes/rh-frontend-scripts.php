<?php
/**
 * Functions to load front-end scripts / styles
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

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
				'src'     => plugins_url( '../assets/css/gridism.css', __FILE__ ),
				'deps'    => '',
				'version' => RECIPE_HERO_VERSION_NUMBER,
				'media'   => 'all'
			),
			'rh-general' => array(
				'src'     => plugins_url( '../assets/css/rh-styles.css', __FILE__ ),
				'deps'    => '',
				'version' => RECIPE_HERO_VERSION_NUMBER,
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
		wp_register_script( 'rh-plugin-script', plugins_url( '../assets/js/rh-scripts.js', __FILE__ ), array( 'jquery' ), RECIPE_HERO_VERSION_NUMBER, true );
		wp_register_script( 'magnific', plugins_url( '../assets/js/jquery.magnific-popup.min.js', __FILE__ ), array( 'jquery' ), RECIPE_HERO_VERSION_NUMBER, true );

		wp_register_style( 'magnific-css', plugins_url( '../assets/css/magnific-popup.css', __FILE__ ), RECIPE_HERO_VERSION_NUMBER, true );

		wp_enqueue_script( 'jquery' );

		// CSS Styles
		wp_enqueue_style( 'dashicons' );
		$enqueue_styles = $this->get_styles();


		if ( $enqueue_styles )
			foreach ( $enqueue_styles as $handle => $args )
				wp_enqueue_style( $handle, $args['src'], $args['deps'], $args['version'], $args['media'] );
	}


	/**
	 * Provide backwards compat for old constant
	 * @param  array $styles
	 * @return array
	 */
	public function backwards_compat( $styles ) {
		if ( defined( 'RECIPE_HERO_USE_CSS' ) ) {
			if ( ! RECIPE_HERO_USE_CSS )
				return false;
		}

		return $styles;
	}

}

new Recipe_Hero_Frontend_Scripts();