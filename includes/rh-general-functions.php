<?php
/**
 * Recepe Hero General Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Returns true if is recipe hero page
 */

function is_recipe_hero() {
    return apply_filters( 'is_recipe_hero', ( is_post_type_archive( 'recipe' ) || is_tax( get_object_taxonomies( 'recipe' ) ) || is_singular( array( 'recipe' ) ) ) ? true : false );
}

/**
 * Returns all ingredeints site-wide
 * Note: We are using get_posts because WP_Query won't work in admin here (https://core.trac.wordpress.org/ticket/18408)
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.9.0
 */

function recipe_hero_sitewide_all_ingredients() {

    $all_ingredients = array();

    $pr_args = array( 
        'post_type' => 'recipe'
        );

    $pr_loop = get_posts( $pr_args );

    foreach ( $pr_loop as $post ) {

        setup_postdata( $post );

        $ingredients = get_post_meta( $post->ID, '_recipe_hero_ingredients_group', true );

        foreach ( ( array ) $ingredients as $key => $ingredient ) {

            $ingredient_name = '';

            if ( isset( $ingredient['name'] ) ) {  

                $ingredient_name = $ingredient['name'];
                
            }

            if ( ! in_array( $ingredient_name, $all_ingredients ) ) {

                $all_ingredients[] = $ingredient_name;

            }

        }

    }

    // Sort the ingredients by alphabetical order
    asort( $all_ingredients );

    return $all_ingredients;

    wp_reset_postdata();

}

/**
 * Clean variables
 *
 * @param string $var
 * @return string
 */
function rh_clean( $var ) {
    return sanitize_text_field( $var );
}

/**
 * Get an image size.
 *
 * Variable is filtered by recipe_hero_get_image_size_{image_size}
 *
 * @param string $image_size
 * @since 1.0.0
 * @return array
 */
function rh_get_image_size( $image_size ) {
    if ( in_array( $image_size, array( 'recipe_single', 'recipe_steps', 'recipe_thumbnail' ) ) ) {
        $size           = get_option( $image_size . '_image_size', array() );
        $size['width']  = isset( $size['width'] ) ? $size['width'] : '300';
        $size['height'] = isset( $size['height'] ) ? $size['height'] : '300';
        $size['crop']   = isset( $size['crop'] ) ? $size['crop'] : 0;
    } else {
        $size = array(
            'width'  => '300',
            'height' => '300',
            'crop'   => 1
        );
    }

    return apply_filters( 'recipe_hero_get_image_size_' . $image_size, $size );
}