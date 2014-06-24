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