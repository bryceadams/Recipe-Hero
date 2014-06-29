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

/**
 * Change 'Enter title here' title placeholder text to something more fitting.
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.5.0
 */

function recipe_hero_change_default_title( $title ){
    $screen = get_current_screen();
    if ( 'recipe' == $screen->post_type ){
        $title = 'Enter Recipe Title';
    }
    return $title;
}
add_filter( 'enter_title_here', 'recipe_hero_change_default_title' );


/**
 * Rename Featured Image Meta Box to 'Recipe Completed Photo'.
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.5.0
 */

function recipe_hero_ftimg_metabox_name() {
	remove_meta_box( 'postimagediv', 'recipe', 'side' );
	add_meta_box('postimagediv', __('Recipe Completed Photo'), 'post_thumbnail_meta_box', 'recipe', 'side', 'low');
}
add_action( 'add_meta_boxes_recipe', 'recipe_hero_ftimg_metabox_name' );


/**
 * Custom Columns for Recipes
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.7.1
 */

add_filter( 'manage_edit-recipe_columns', 'recipe_hero_recipe_columns' ) ;
function recipe_hero_recipe_columns( $columns ) {

    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => __( 'Recipe Title' ),
        'id'        => __( 'ID' ),
        'course'    => __( 'Course' ),
        'cuisine'   => __( 'Cuisine' ),
        'photo'     => __( 'Photo' ),
        'author'    => __( 'Author' ),
        'comments'  => '<span class="dashicons dashicons-admin-comments"></span>',
        'date'      => __( 'Date' )
    );

    return $columns;
}

add_action( 'manage_recipe_posts_custom_column', 'recipe_hero_manage_recipe_columns', 10, 2 );
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
        

        default :
            break;
    }
}


/**
 * Add Sorting Ability to Courses / Cuisines
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.7.1
 */

add_filter( 'manage_edit-recipe_sortable_columns', 'recipe_hero_recipe_sort_columns' );
function recipe_hero_recipe_sort_columns( $columns ) {

    $columns['course'] = 'course';
    $columns['cuisine'] = 'cuisine';

    return $columns;
}

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
add_filter( 'posts_orderby', 'recipe_hero_orderby', 10, 2 );

/**
 * Admin Notice on Plugin Activation
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.7.1
 * @todo 	Make it so that the user_meta data is only added on the permalinks page
 */

add_action( 'admin_notices', 'recipe_hero_admin_notice' );
function recipe_hero_admin_notice() {
	global $current_user;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta( $user_id, 'rh_ignore_notice' ) ) {
        if ( current_user_can( 'publish_posts' ) ) {
            echo '<div class="updated"><p>'; 
            _e( 'Thanks for using Recipe Hero! Please', 'recipe-hero' );
            echo ' <strong><a href="' . get_admin_url() . 'options-permalink.php' . '">';
            _e( 're-save your permalinks', 'recipe-hero' );
            echo '</a></strong> ';
            _e( 'to get started (this notice will disappear afterwards).', 'recipe-hero' );
            echo "</p></div>";
        }
	}
}
add_action( 'admin_init', 'recipe_hero_nag_ignore' );
function recipe_hero_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
             add_user_meta( $user_id, 'rh_ignore_notice', 'true', true );
	}
}