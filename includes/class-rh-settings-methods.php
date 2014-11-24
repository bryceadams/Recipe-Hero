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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Recipe_Hero_Settings_Methods {

    function __construct() {
 
    	add_action( 'wp_enqueue_scripts', array( $this, 'option_enable_lightbox' ), 9999 );
		add_filter( 'comments_open', array( $this, 'override_comments_open' ), 1000);

    }

    /**
	 * Disable Lightbox
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  0.8.0
	 */

	public function option_enable_lightbox() {

		if ( get_option( 'recipe_hero_enable_lightbox' ) == '' || get_option( 'recipe_hero_enable_lightbox' ) == 'yes' ) {

			if ( ( get_post_type() == 'recipe' ) && is_single() ) {

				wp_enqueue_script( 'magnific' );
				wp_enqueue_script( 'rh-lightbox' );
				wp_enqueue_style( 'magnific-css' );

			}

		}

	}

	/**
	 * Specified Recipe Home Page - Hide Comments (if turned on)
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  1.0.0
	 */

	public function override_comments_open( $close ) {

		global $post;

		if ( get_option( 'recipe_hero_recipes_page_id' ) ) {
            
            $rh_home_id = get_option( 'recipe_hero_recipes_page_id' );
    
            if ( isset( $rh_home_id ) ) {
				if ( $post->ID == $rh_home_id ) {
					$close = false;
				}
			}

		}
		
	    return $close;

	}

}

new Recipe_Hero_Settings_Methods;