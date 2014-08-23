<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
 /**
 * Register 'Recipe' Custom Post Type.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.9.0
 */

add_action( 'init', 'recipe_hero_register_recipe_posttype' );

if ( ! function_exists( 'recipe_hero_register_recipe_posttype' ) ) {
	
	function recipe_hero_register_recipe_posttype() {
		$labels 		= array(
			'name' 				=> _x( 'Recipes', 'post type general name' ),
			'singular_name'		=> _x( 'Recipe', 'post type singular name' ),
			'add_new' 			=> __( 'Add New Recipe' ),
			'add_new_item' 		=> __( 'Add New Recipe' ),
			'edit_item' 		=> __( 'Edit Recipe' ),
			'new_item' 			=> __( 'New Recipe' ),
			'view_item' 		=> __( 'View Recipe' ),
			'search_items' 		=> __( 'Search Recipes' ),
			'not_found' 		=> __( 'No Recipes found' ),
			'not_found_in_trash'=> __( 'No Recipes found in the trash' ),
			'parent_item_colon' => '',
			'menu_name'			=> __( 'Recipe Hero' )
		);
		
		$taxonomies 	= array();

		$supports   	= array( 'title','editor','author','thumbnail','excerpt','comments','revisions', 'publicize' );
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __( 'Recipe' ),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array( 'slug' => 'recipes', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 35,
			'menu_icon' 		=> 'dashicons-shield',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type( 'recipe', $post_type_args );
	}

}