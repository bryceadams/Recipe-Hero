<?php
/**
 * Altering layout of Recipes in Admin with Columns etc.
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
 * Custom Columns for Recipes
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.9.0
 */

add_filter( 'manage_edit-recipe_columns', 'recipe_hero_recipe_columns' ) ;
if ( ! function_exists( 'recipe_hero_recipe_columns' ) ) {
    
    function recipe_hero_recipe_columns( $columns ) {

        $columns = array(
            'cb'        => '<input type="checkbox" />',
            'title'     => __( 'Recipe Title', 'recipe-hero' ),
            'id'        => __( 'ID', 'recipe-hero' ),
            'course'    => __( 'Course', 'recipe-hero' ),
            'cuisine'   => __( 'Cuisine', 'recipe-hero' ),
            'ingredients' => __( 'Ingredients', 'recipe-hero' ),
            'photo'     => __( 'Photo', 'recipe-hero' ),
            'author'    => __( 'Author', 'recipe-hero' ),
            'comments'  => '<span class="dashicons dashicons-admin-comments"></span>',
            'date'      => __( 'Date', 'recipe-hero' )
        );

        return $columns;
    }

}

add_action( 'manage_recipe_posts_custom_column', 'recipe_hero_manage_recipe_columns', 10, 2 );
if ( ! function_exists( 'recipe_hero_manage_recipe_columns' ) ) {
    
    function recipe_hero_manage_recipe_columns( $column, $post_id ) {
        
        global $post;

        switch( $column ) {

            case 'id' :

                echo $post_id;

                break;

            case 'photo' :

                if ( has_post_thumbnail() ) {
                    echo get_the_post_thumbnail( $post_id, 'rh-admin-column' );
                }

                break;

            case 'course' :

                $terms = get_the_terms( $post_id, 'course' );

                if ( !empty( $terms ) ) {

                    $out = array();

                    foreach ( $terms as $term ) {
                        $out[] = sprintf( '<a href="%s">%s</a>',
                            esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'course' => $term->slug ), 'edit.php' ) ),
                            esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'course', 'display' ) )
                        );
                    }

                    echo join( ', ', $out );
                }

                else {
                    _e( 'No Courses', 'recipe-hero' );
                }

                break;

            case 'cuisine' :

                $terms = get_the_terms( $post_id, 'cuisine' );

                if ( !empty( $terms ) ) {

                    $out = array();

                    foreach ( $terms as $term ) {
                        $out[] = sprintf( '<a href="%s">%s</a>',
                            esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'cuisine' => $term->slug ), 'edit.php' ) ),
                            esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'cuisine', 'display' ) )
                        );
                    }

                    echo join( ', ', $out );
                }

                else {
                    _e( 'No Cuisines', 'recipe-hero' );
                }

                break;

            case 'ingredients' :

                $ingredients = get_post_meta( $post->ID, '_recipe_hero_ingredients_group', true );
        
                foreach ( ( array ) $ingredients as $key => $ingredient ) {

                    $ingredient_name = '';

                    if ( isset( $ingredient['name'] ) ) {  

                        $ingredient_name = $ingredient['name'];
                        
                    }

                    echo $ingredient_name . '<br />';

                }

                break;

            default :
                break;
        }
        
    }
    
}


/**
 * Add Sorting Ability to Courses / Cuisines
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.8.1
 */

add_filter( 'manage_edit-recipe_sortable_columns', 'recipe_hero_recipe_sort_columns' );
if ( ! function_exists( 'recipe_hero_recipe_sort_columns' ) ) {
    
    function recipe_hero_recipe_sort_columns( $columns ) {

        $columns['course'] = 'course';
        $columns['cuisine'] = 'cuisine';

        return $columns;
        
    }
    
}

if ( ! function_exists( 'recipe_hero_orderby' ) ) {
    
    function recipe_hero_orderby( $orderby, $wp_query ) {
        global $wpdb;

        if ( isset( $wp_query->query['orderby'] ) && 'course' == $wp_query->query['orderby'] ) {
            $orderby = "(
                SELECT GROUP_CONCAT(name ORDER BY name ASC)
                FROM $wpdb->term_relationships
                INNER JOIN $wpdb->term_taxonomy USING (term_taxonomy_id)
                INNER JOIN $wpdb->terms USING (term_id)
                WHERE $wpdb->posts.ID = object_id
                AND taxonomy = 'course'
                GROUP BY object_id
            ) ";
            $orderby .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
        }

        if ( isset( $wp_query->query['orderby'] ) && 'cuisine' == $wp_query->query['orderby'] ) {
            $orderby = "(
                SELECT GROUP_CONCAT(name ORDER BY name ASC)
                FROM $wpdb->term_relationships
                INNER JOIN $wpdb->term_taxonomy USING (term_taxonomy_id)
                INNER JOIN $wpdb->terms USING (term_id)
                WHERE $wpdb->posts.ID = object_id
                AND taxonomy = 'cuisine'
                GROUP BY object_id
            ) ";
            $orderby .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
        }

        return $orderby;
    }
    
}
add_filter( 'posts_orderby', 'recipe_hero_orderby', 10, 2 );