<?php
/**
 * Adding Template-related Actions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  0.7.1
 */

/**
 * Content Wrappers
 *
 * @see recipe_hero_output_content_wrapper() - 10
 * @see recipe_hero_output_content_wrapper_end() - 10
 */
add_action( 'recipe_hero_before_main_content', 'recipe_hero_output_content_wrapper', 10 );
add_action( 'recipe_hero_after_main_content', 'recipe_hero_output_content_wrapper_end', 10 );


/**
 * Taxonomy Titles / Descriptions
 *
 * @see recipe_hero_archive_tax_title - 20
 * @see recipe_hero_archive_tax_desc - 30
 */
add_action( 'recipe_hero_before_main_content', 'recipe_hero_archive_tax_title', 20 );
add_action( 'recipe_hero_before_main_content', 'recipe_hero_archive_tax_desc', 30 );

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
 * @see recipe_hero_output_single_title() - 10
 * @see recipe_hero_output_single_meta - 20
 * @see recipe_hero_output_single_header_after - 25
 * @see recipe_hero_output_single_photo - 30
 * @see recipe_hero_output_single_tax() - 40
 * @see recipe_hero_output_single_details() - 50
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

/**
 * Recipe After Single Content
 *
 * @see recipe_hero_output_single_comments() - 10
 */
add_action( 'recipe_hero_after_single_recipe', 'recipe_hero_output_single_comments', 10 );

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