<?php
/**
 * Adding Template-related Actions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Add body class
add_filter( 'body_class', 'recipe_hero_body_class' );

/**
 * Content Wrappers
 *
 * @see recipe_hero_output_content_wrapper() - 10
 * @see recipe_hero_output_content_wrapper_end() - 10
 */
add_action( 'recipe_hero_before_main_content', 'recipe_hero_output_content_wrapper', 10 );
add_action( 'recipe_hero_after_main_content', 'recipe_hero_output_content_wrapper_end', 10 );

/**
 * Recipe Archive / Tax Description
 *
 * @see recipe_hero_recipes_archive_description - 10
 * @see recipe_hero_taxonomy_archive_description - 20
 */
add_action( 'recipe_hero_archive_description', 'recipe_hero_recipes_archive_description', 10 );
add_action( 'recipe_hero_archive_description', 'recipe_hero_taxonomy_archive_description', 20 );

/**
 * Search Results Page
 *
 * @see recipe_hero_output_search_header - 40
 */
add_action( 'recipe_hero_before_main_content', 'recipe_hero_output_search_header', 40 );

/**
 * Sidebar
 *
 * @see recipe_hero_display_sidebar_right() - 10
 */
add_action( 'recipe_hero_sidebar_right', 'recipe_hero_get_sidebar', 10 );

/**
 * Recipe Single Content
 *
 * @see recipe_hero_output_single_header_before - 5
 * @see recipe_hero_output_single_title - 10
 * @see recipe_hero_output_single_meta - 20
 * @see recipe_hero_output_single_header_after - 25
 * @see recipe_hero_output_single_photo - 30
 * @see recipe_hero_output_single_tax() - 40
 * @see recipe_hero_output_single_details - 50
 * @see recipe_hero_output_single_description - 60
 * @see recipe_hero_output_single_ingredients - 70
 * @see recipe_hero_output_single_instructions - 80
 * @see recipe_hero_output_single_nutrition - 90
 * @see recipe_hero_output_jetpack_sharing_buttons - 100
 */
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_header_before', 5 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_title', 10 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_meta', 20 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_header_after', 25 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_photo', 30 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_tax', 40 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_details', 50 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_description', 60 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_ingredients', 70 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_instructions', 80 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_single_nutrition', 90 );
add_action( 'recipe_hero_single_recipe_content', 'recipe_hero_output_jetpack_sharing_buttons', 100 );

add_action( 'recipe_hero_recipe_thumbnails', 'recipe_hero_output_single_thumbnails', 10 );

/**
 * Recipe After Single Content
 *
 * @see recipe_hero_output_single_comments() - 10
 */
add_action( 'recipe_hero_after_single_recipe', 'recipe_hero_output_single_comments', 10 );

/**
 * Recipe Ingredients Form
 *
 * @see recipe_hero_output_ingredients_form_start - 10
 * @see recipe_hero_output_ingredients_form_end - 10
 * @see recipe_hero_output_ingredients_form_checkbox - 10
 */

add_action( 'recipe_hero_before_ingredients_list', 'recipe_hero_output_ingredients_form_start', 10 );
add_action( 'recipe_hero_after_ingredients_list', 'recipe_hero_output_ingredients_form_end', 10 );
add_action( 'recipe_hero_before_ingredients_list_item', 'recipe_hero_output_ingredients_form_checkbox', 10 );


/**
 * Recipe Archive Content
 *
 * @see recipe_hero_output_single_header_before - 5
 * @see recipe_hero_output_archive_title() - 10
 * @see recipe_hero_output_archive_meta - 20
 * @see recipe_hero_output_single_header_after - 25
 * @see recipe_hero_output_archive_photo - 30
 * @see recipe_hero_output_archive_tax - 40
 * @see recipe_hero_output_archive_details - 50
 * @see recipe_hero_output_archive_description - 60
 */
add_action( 'recipe_hero_archive_recipe_content', 'recipe_hero_output_single_header_before', 5 );
add_action( 'recipe_hero_archive_recipe_content', 'recipe_hero_output_archive_title', 10 );
add_action( 'recipe_hero_archive_recipe_content', 'recipe_hero_output_archive_meta', 20 );
add_action( 'recipe_hero_archive_recipe_content', 'recipe_hero_output_single_header_after', 25 );
add_action( 'recipe_hero_archive_recipe_content', 'recipe_hero_output_archive_photo', 30 );
add_action( 'recipe_hero_archive_recipe_content', 'recipe_hero_output_archive_tax', 40 );
add_action( 'recipe_hero_archive_recipe_content', 'recipe_hero_output_archive_details', 50 );
add_action( 'recipe_hero_archive_recipe_content', 'recipe_hero_output_archive_description', 60 );

/*
 * Recipe Archive Lopp
 *
 * @see recipe_hero_output_loop_pagination - 10
 */
add_action( 'recipe_hero_after_main_loop', 'recipe_hero_output_loop_pagination', 10 );