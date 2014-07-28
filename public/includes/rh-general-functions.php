<?php
/**
 * Recepe Hero General Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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