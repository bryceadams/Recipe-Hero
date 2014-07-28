<?php
/**
 * Add Help Tab to Recipes Admin Pages
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
 * Standard Help Tab for admin list of Recipes
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.8.0
 * @todo    Add more information, etc.
 */

add_action('admin_menu', 'recipe_hero_admin_help_tab');
if ( ! function_exists( 'recipe_hero_admin_help_tab' ) ) {

    function recipe_hero_admin_help_tab() {
        $recipe_hero_help_edit_page = 'edit.php';
        $recipe_hero_help_post_new_page = 'post-new.php';
        $recipe_hero_settings_page =    add_submenu_page(
                                            '',               // The ID of the top-level menu page to which this submenu item belongs
                                            __( 'Recipe Hero Settings', 'recipe-hero' ),         // The value used to populate the browser's title bar when the menu page is active
                                            __( 'New Settings', 'recipe-hero' ),                 // The label of this submenu item displayed in the menu
                                            'administrator',                    // What roles are able to access this submenu item
                                            'recipe_hero_general_options',    // The ID used to represent this submenu item
                                            'recipe_hero_general'             // The callback function used to render the options for this submenu item
                                        );
        $recipe_hero_settings_page_2 =  add_submenu_page(
                                            '',    // leave blank so no menu page created
                                            __( 'Style', 'recipe-hero' ),
                                            __( 'Style', 'recipe-hero' ),
                                            'administrator',
                                            'recipe_hero_style_options'
                                        );
        $recipe_hero_settings_page_3 =  add_submenu_page(
                                            '', // leave blank so no menu page created
                                            __( 'Labels', 'recipe-hero' ),
                                            __( 'Labels', 'recipe-hero' ),
                                            'administrator',
                                            'recipe_hero_labels_options'
                                        );

        $screen = get_current_screen();
        if ( recipe_hero_admin_get_current_post_type() == 'recipe' ) {
            add_action( 'load-' . $recipe_hero_help_edit_page, 'recipe_hero_admin_add_help_tab' );
            add_action( 'load-' . $recipe_hero_help_post_new_page, 'recipe_hero_admin_add_help_tab' );
            add_action( 'load-' . $recipe_hero_settings_page, 'recipe_hero_admin_add_help_tab' );
            add_action( 'load-' . $recipe_hero_settings_page_2, 'recipe_hero_admin_add_help_tab' );
            add_action( 'load-' . $recipe_hero_settings_page_3, 'recipe_hero_admin_add_help_tab' );
        }
    }

}

if ( ! function_exists( 'recipe_hero_admin_add_help_tab' ) ) {

    function recipe_hero_admin_add_help_tab () {

        global $recipe_hero_help_page;
        $screen = get_current_screen();

        // Add my_help_tab if current screen is My Admin Page
        $screen->add_help_tab( array(
            'id'      => 'recipe_hero_help_tab',
            'title'   => __( 'Documentation', 'recipe-hero' ),
            'content' => '<p>' . sprintf( __( 'You can access the documentation over at the <a href="%s">Recipe Hero Documentation</a>.', 'recipe-hero' ), 'http://recipehero.in/docs/' ) . '</p>',
        ) );

        $screen->add_help_tab( array(
            'id'      => 'recipe_hero_support_tab',
            'title'   => __( 'Support', 'recipe-hero' ),
            'content' => '<p>' . sprintf( __( 'You can post a support thread on <a href="%s">Recipe Hero Support Forum</a>.', 'recipe-hero' ), 'http://recipehero.in/support/' ) . '</p>',
        ) );

    }

}


/**
 * Gets the current post type in the WordPress Admin
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.7.1
 */

function recipe_hero_admin_get_current_post_type() {

    global $post, $typenow, $current_screen;
      
    //we have a post so we can just get the post type from that
    if ( $post && $post->post_type )
      return $post->post_type;
      
    //check the global $typenow - set in admin.php
    elseif( $typenow )
      return $typenow;
      
    //check the global $current_screen object - set in sceen.php
    elseif( $current_screen && $current_screen->post_type )
      return $current_screen->post_type;
    
    //lastly check the post_type querystring
    elseif( isset( $_REQUEST['post_type'] ) )
      return sanitize_key( $_REQUEST['post_type'] );
      
    //we do not know the post type!
    return null;

}