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
 * Register 'Course' Taxonomy.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.9.0
 */

add_action( 'init', 'recipe_hero_register_course_tax' );

if ( ! function_exists( 'recipe_hero_register_course_tax' ) ) {

	function recipe_hero_register_course_tax() {
		$labels = array(
			'name' 					=> _x( 'Courses', 'taxonomy general name' ),
			'singular_name' 		=> _x( 'Course', 'taxonomy singular name' ),
			'add_new' 				=> _x( 'Add New Course', 'Course'),
			'add_new_item' 			=> __( 'Add New Course' ),
			'edit_item' 			=> __( 'Edit Course' ),
			'new_item' 				=> __( 'New Course' ),
			'view_item' 			=> __( 'View Course' ),
			'search_items' 			=> __( 'Search Courses' ),
			'not_found' 			=> __( 'No Course found' ),
			'not_found_in_trash' 	=> __( 'No Course found in Trash' ),
		);
		
		$pages = array('recipe');
		
		$args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __( 'Course' ),
			'public' 			=> true,
			'show_ui' 			=> true,
			'hierarchical' 		=> false,
			'show_tagcloud' 	=> false,
			'show_in_nav_menus' => false,
			'rewrite' 			=> array('slug' => 'courses', 'with_front' => false ),
		 );
		register_taxonomy( 'course', $pages, $args );
	}

}

 /**
 * Register 'Cuisine' Taxonomy.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

add_action( 'init', 'recipe_hero_register_cuisine_tax' );

if ( ! function_exists( 'recipe_hero_register_cuisine_tax' ) ) {

	function recipe_hero_register_cuisine_tax() {
		$labels = array(
			'name' 					=> _x( 'Cuisines', 'taxonomy general name' ),
			'singular_name' 		=> _x( 'Cuisine', 'taxonomy singular name' ),
			'add_new' 				=> _x( 'Add New Cuisine', 'Cuisine'),
			'add_new_item' 			=> __( 'Add New Cuisine' ),
			'edit_item' 			=> __( 'Edit Cuisine' ),
			'new_item' 				=> __( 'New Cuisine' ),
			'view_item' 			=> __( 'View Cuisine' ),
			'search_items' 			=> __( 'Search Cuisines' ),
			'not_found' 			=> __( 'No Cuisine found' ),
			'not_found_in_trash' 	=> __( 'No Cuisine found in Trash' ),
		);
		
		$pages = array('recipe');
		
		$args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __( 'Cuisine' ),
			'public' 			=> true,
			'show_ui' 			=> true,
			'hierarchical' 		=> false,
			'show_tagcloud' 	=> false,
			'show_in_nav_menus' => false,
			'rewrite' 			=> array( 'slug' => 'cuisines', 'with_front' => false ),
		 );
		register_taxonomy( 'cuisine', $pages, $args );
	}

}