<?php
/**
 * Template Display Parts for Supporting Other Plugins / Extensions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */
 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
 /**
 * Add Jetpack Sharing Buttons
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 */

if ( ! function_exists( 'recipe_hero_output_jetpack_sharing_buttons' ) ) {
	
	function recipe_hero_output_jetpack_sharing_buttons() {
		
		if ( function_exists( 'sharing_display' ) ) {
	    	sharing_display( '', true );
		}
	 
		if ( class_exists( 'Jetpack_Likes' ) ) {
		    $custom_likes = new Jetpack_Likes;
		    echo $custom_likes->post_likes( '' );
		}

	}

}

 /**
 * Hide Jetpack Sharing From Content on Single Recipes
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

add_action ( 'the_post', 'recipe_hero_hide_jetpack_single_content', 11 );

if ( ! function_exists( 'recipe_hero_hide_jetpack_single_content' ) ) {

	function recipe_hero_hide_jetpack_single_content() {

		global $post;

		if ( ! function_exists( 'sharing_display' ) ) {
	  		return;
	  	}

	    if ( is_singular( 'recipe' ) ) {
	        remove_filter( 'the_content', 'sharing_display', 19 );
	    }
	    
	}

}