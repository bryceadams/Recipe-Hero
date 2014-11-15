<?php
/**
 * Admin Tweaks
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


class Recipe_Hero_Admin_Tweaks {

    function __construct() {
 
        add_filter( 'enter_title_here', array( $this, 'change_default_title' ) );
        add_action( 'add_meta_boxes_recipe', array( $this, 'ftimg_metabox_name' ) );

        add_action( 'admin_notices', array( $this, 'admin_notice' ) );
        add_action( 'admin_init', array( $this, 'nag_ignore' ) );

    }

    /**
     * Change 'Enter title here' title placeholder text to something more fitting.
     *
     * @package Recipe Hero
     * @author  Captain Theme <info@captaintheme.com>
     * @since   0.9.0
     */

    public function change_default_title( $title ) {

        $screen = get_current_screen();

        if ( 'recipe' == $screen->post_type ){
            $title = __( 'Enter Recipe Title', 'recipe-hero' );
        }

        return $title;

    }

    /**
     * Rename Featured Image Meta Box to 'Recipe Completed Photo'.
     *
     * @package Recipe Hero
     * @author  Captain Theme <info@captaintheme.com>
     * @since   0.9.0
     */
    
    public function ftimg_metabox_name() {

        remove_meta_box( 'postimagediv', 'recipe', 'side' );
        add_meta_box('postimagediv', __( 'Recipe Completed Photo', 'recipe-hero' ), 'post_thumbnail_meta_box', 'recipe', 'side', 'low' );

    }


    /**
     * Admin Notice on Plugin Activation
     *
     * @package Recipe Hero
     * @author  Captain Theme <info@captaintheme.com>
     * @since   0.9.0
     * @todo    Make it so that the user_meta data is only added on the permalinks page & improve i18n strings
     */

    public function admin_notice() {

        global $current_user;
        $user_id = $current_user->ID;

        if ( ! get_user_meta( $user_id, 'rh_ignore_notice' ) ) {
            if ( current_user_can( 'publish_posts' ) ) {
                echo '<div class="updated"><p>'; 
                _e( 'Thanks for using Recipe Hero! Please', 'recipe-hero' );
                echo ' <strong><a href="' . get_admin_url() . 'options-permalink.php' . '">';
                _e( 're-save your permalinks', 'recipe-hero' );
                echo '</a></strong> ';
                _e( 'to get started (this notice will disappear afterwards).', 'recipe-hero' );
                echo '</p></div>';
            }
        }

    }

    public function nag_ignore() {

        global $current_user;
        $user_id = $current_user->ID;
            
        if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
             add_user_meta( $user_id, 'rh_ignore_notice', 'true', true );
        }

    }

}

new Recipe_Hero_Admin_Tweaks;