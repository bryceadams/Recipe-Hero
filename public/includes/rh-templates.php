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
 * Tell WordPress not to use single.php for Recipe Single Posts
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   1.0
 */
 
add_filter( 'template_include', 'recipe_hero_tc_template_chooser');

function recipe_hero_tc_template_chooser( $template ) {
 
    // Post ID
    $post_id = get_the_ID();
 
    // For all other CPT
    if ( get_post_type( $post_id ) != 'recipe' ) {
        return $template;
    }
 
    // Else use custom template
    if ( is_single() ) {
        return recipe_hero_tc_get_template_hierarchy( 'single' );
    }
    if ( is_archive() ) {
        return recipe_hero_tc_get_template_hierarchy( 'archive' );
    }
 
}

/**
 * Template Loading for Recipe Single Posts
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   1.0
 */

function recipe_hero_tc_get_template_hierarchy( $template ) {
 
    // Get the template slug
    $template_slug = rtrim( $template, '.php' );
    $template = $template_slug . '.php';
 
    // Check if a custom template exists in the theme folder, if not, load the plugin template file
    if ( $theme_file = locate_template( array( 'templates/' . $template ) ) ) {
        $file = $theme_file;
    }
    else {
        $file = RECIPE_HERO_PLUGIN_DIR . '/templates/' . $template;
    }
 
    return apply_filters( 'recipe_hero_repl_template_' . $template, $file );
}

/**
 * Get Template Parts for Recipes
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   1.0
 */

function recipe_hero_get_template_part( $slug, $name = '' ) {
    $template = '';

    // Look in yourtheme/slug-name.php and yourtheme/woocommerce/slug-name.php
    if ( $name ) {
        $template = locate_template( array( "{$slug}-{$name}.php", RECIPE_HERO_TEMPLATE_DIR . "{$slug}-{$name}.php" ) );
    }

    // Get default slug-name.php
    if ( ! $template && $name && file_exists( RECIPE_HERO_PLUGIN_DIR . "/templates/{$slug}-{$name}.php" ) ) {
        $template = RECIPE_HERO_PLUGIN_DIR . "/templates/{$slug}-{$name}.php";
    }

    // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce/slug.php
    if ( ! $template ) {
        $template = locate_template( array( "{$slug}.php", RECIPE_HERO_TEMPLATE_DIR . "{$slug}.php" ) );
    }

    // Allow 3rd party plugin filter template file from their plugin
    $template = apply_filters( 'recipe_hero_get_template_part', $template, $slug, $name );

    if ( $template ) {
        load_template( $template, false );
    }
}



/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function recipe_hero_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
    if ( $args && is_array( $args ) ) {
        extract( $args );
    }

    $located = recipe_hero_locate_template( $template_name, $template_path, $default_path );

    if ( ! file_exists( $located ) ) {
        _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
        return;
    }

    do_action( 'recipe_hero_before_template_part', $template_name, $template_path, $located, $args );

    include( $located );

    do_action( 'recipe_hero_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_path  /   $template_name
 *      yourtheme       /   $template_name
 *      $default_path   /   $template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function recipe_hero_locate_template( $template_name, $template_path = '', $default_path = '' ) {
    if ( ! $template_path ) {
        $template_path = RECIPE_HERO_TEMPLATE_DIR;
    }

    if ( ! $default_path ) {
        $default_path = RECIPE_HERO_PLUGIN_DIR . '/templates/';
    }

    // Look within passed path within the theme - this is priority
    $template = locate_template(
        array(
            trailingslashit( $template_path ) . $template_name,
            $template_name
        )
    );

    // Get default template
    if ( ! $template ) {
        $template = $default_path . $template_name;
    }

    // Return what we found
    return apply_filters('recipe_hero_locate_template', $template, $template_name, $template_path);
}