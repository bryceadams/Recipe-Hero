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
 * Admin Notice on Plugin Activation
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.6.0
 * @todo 	Make it so that the user_meta data is only added on the permalinks page
 */

add_action( 'admin_notices', 'recipe_hero_admin_notice' );
function recipe_hero_admin_notice() {
	global $current_user;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta( $user_id, 'rh_ignore_notice' ) ) {
        echo '<div class="updated"><p>'; 
        _e( 'Thanks for using Recipe Hero! Please', 'recipe-hero' );
        echo ' <strong><a href="' . get_admin_url() . 'options-permalink.php' . '">';
        _e( 're-save your permalinks', 'recipe-hero' );
        echo '</a></strong> ';
        _e( 'to get started (this notice will disappear afterwards).', 'recipe-hero' );
        echo "</p></div>";
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