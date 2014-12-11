<?php
/**
 * Templating engine - loads the correct template file based on overrides, settings, etc.
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


add_filter( 'comments_template', 'recipe_hero_comments_template_loader' );
function recipe_hero_comments_template_loader( $template ) {

    if ( get_post_type() !== 'recipe' ) {
        return $template;
    }

    $check_dirs = array(
        trailingslashit( get_stylesheet_directory() ) . RH()->template_path(),
        trailingslashit( get_template_directory() ) . RH()->template_path(),
        trailingslashit( get_stylesheet_directory() ),
        trailingslashit( get_template_directory() ),
        trailingslashit( RH()->plugin_path() ) . 'templates/'
    );

    foreach ( $check_dirs as $dir ) {
        if ( file_exists( trailingslashit( $dir ) . 'single-recipe-reviews.php' ) ) {
            return trailingslashit( $dir ) . 'single-recipe-reviews.php';
        }
    }

}


/**
 * Tell WordPress not to use single.php for Recipe Single Posts
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   1.0.0
 */
 
add_filter( 'template_include', 'recipe_hero_tc_template_chooser');
if ( ! function_exists( 'recipe_hero_tc_template_chooser' ) ) {

    function recipe_hero_tc_template_chooser( $template ) {

        global $post;

        if ( ! empty ( $post ) ) {
            $post_id = $post->ID;
        } else {
            return $template;
        }

        if ( get_option( 'recipe_hero_recipes_page_id' ) ) {
            
            $rh_home_id = get_option( 'recipe_hero_recipes_page_id' );
    
            if ( isset( $rh_home_id ) ) {
                if ( $post_id == $rh_home_id ) {
                    return recipe_hero_tc_get_template_hierarchy( 'archive' );
                }
            }

        }
        
        if ( get_post_type( $post_id ) == 'recipe' ) {

            // Else use custom template
            if ( is_single() ) {
            
                return recipe_hero_tc_get_template_hierarchy( 'single' );
            
            } elseif ( is_archive() || is_page( rh_get_page_id( 'recipes' ) ) ) {

                return recipe_hero_tc_get_template_hierarchy( 'archive' );

            } elseif ( is_search() ) {

                return recipe_hero_tc_get_template_hierarchy( 'search-results' );

            } else {

                return $template;

            }

        }

        return $template;
        
    }

}

/**
 * Template Loading for Recipe Single Posts
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.7.0
 */

if ( ! function_exists( 'recipe_hero_tc_get_template_hierarchy' ) ) {
    
    function recipe_hero_tc_get_template_hierarchy( $template ) {
     
        // Get the template slug
        $template_slug = rtrim( $template, '.php' );
        $template = $template_slug . '.php';
     
        // Check if a custom template exists in the theme folder, if not, load the plugin template file
        if ( $theme_file = locate_template( array( 'recipe-hero/' . $template ) ) ) {
            $file = $theme_file;
        }
        else {
            $file = RH()->plugin_path() . '/templates/' . $template;
        }
     
        return apply_filters( 'recipe_hero_repl_template_' . $template, $file );
    }

}

/**
 * Get Template Parts for Recipes
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.7.0
 */

if ( ! function_exists( 'recipe_hero_get_template_part' ) ) {
    
    function recipe_hero_get_template_part( $slug, $name = '' ) {

        $template = '';

        // Look in yourtheme/slug-name.php and yourtheme/recipe-hero/slug-name.php
        if ( $name ) {
            $template = locate_template( array( "{$slug}-{$name}.php", RH()->template_path() . "{$slug}-{$name}.php" ) );
        }

        // Get default slug-name.php
        if ( ! $template && $name && file_exists( RH()->plugin_path() . "/templates/{$slug}-{$name}.php" ) ) {
            $template = RH()->plugin_path() . "/templates/{$slug}-{$name}.php";
        }

        // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/recipe-hero/slug.php
        if ( ! $template ) {
            $template = locate_template( array( "{$slug}.php", RH()->template_path() . "{$slug}.php" ) );
        }

        // Allow 3rd party plugin filter template file from their plugin
        $template = apply_filters( 'recipe_hero_get_template_part', $template, $slug, $name );

        if ( $template ) {
            load_template( $template, false );
        }

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
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.7.0
 */

if ( ! function_exists( 'recipe_hero_get_template' ) ) {

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
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   0.8.0
 */

if ( ! function_exists( 'recipe_hero_locate_template' ) ) {

    function recipe_hero_locate_template( $template_name, $template_path = '', $default_path = '' ) {
        
        if ( ! $template_path ) {
            $template_path = RH()->template_path();
        }

        if ( ! $default_path ) {

            $default_path = RH()->plugin_path() . '/templates/';
        
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
        return apply_filters( 'recipe_hero_locate_template', $template, $template_name, $template_path );

    }

}