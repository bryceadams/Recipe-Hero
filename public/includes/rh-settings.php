<?php
/**
 * Recipe Hero Settings / Options Fields
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since     0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function recipe_hero_example_menu() {

    add_submenu_page(
        'edit.php?post_type=recipe',
        __( 'Recipe Hero Settings', 'recipe-hero' ),
        __( 'Settings', 'recipe-hero' ),
        'administrator',
        'recipe_hero_general_options',
        'recipe_hero_general'
    );

    add_submenu_page(
        '',    // leave blank so no menu page created
        __( 'Style', 'recipe-hero' ),
        __( 'Style', 'recipe-hero' ),
        'administrator',
        'recipe_hero_style_options',
        create_function( null, 'recipe_hero_general( "style_options" );' )
    );
    
    add_submenu_page(
        '', // leave blank so no menu page created
        __( 'Labels', 'recipe-hero' ),
        __( 'Labels', 'recipe-hero' ),
        'administrator',
        'recipe_hero_labels_options',
        create_function( null, 'recipe_hero_general( "labels_options" );' )
    );


}
add_action( 'admin_menu', 'recipe_hero_example_menu' );

function recipe_hero_general( $active_tab = '' ) {
?>
    <div class="wrap recipe-hero-settings">

        <?php if( $active_tab == 'style_options' ) {

            $active_tab = 'style_options';

        } else if( $active_tab == 'labels_options' ) {

            $active_tab = 'labels_options';

        } else {

            $active_tab = 'general_options';

        } ?>

        <header class="rhs-header">
               
                <ul>
                    <li>
                        <h1>
                            <span class="dashicons dashicons-shield" style="font-size: 28px; padding-right: 15px;"></span>
                            <?php _e( 'Recipe Hero Settings', 'recipe-hero' ); ?>
                        </h1>
                    </li>
                    <li class="<?php echo $active_tab == 'general_options' ? 'active' : ''; ?> pages">
                        <a href="?post_type=recipe&page=recipe_hero_general_options"><?php _e( 'General', 'recipe-hero' ); ?></a>
                    </li>
                    <li class="<?php echo $active_tab == 'style_options' ? 'active' : ''; ?> pages">
                        <a href="?post_type=recipe&page=recipe_hero_style_options"><?php _e( 'Style', 'recipe-hero' ); ?></a>
                    </li>
                    <li class="<?php echo $active_tab == 'labels_options' ? 'active' : ''; ?> pages">
                        <a href="?post_type=recipe&page=recipe_hero_labels_options"><?php _e( 'Labels', 'recipe-hero' ); ?></a>
                    </li>
                </ul>
    
        </header>
        
        <?php settings_errors(); ?>

        <form method="post" action="options.php" class="rhs-fields">
            <?php
            
                if( $active_tab == 'general_options' ) {
                
                    settings_fields( 'recipe_hero_general_options' );
                    do_settings_sections( 'recipe_hero_general_options' );
                    
                } elseif( $active_tab == 'style_options' ) {
                
                    settings_fields( 'recipe_hero_style_options' );
                    do_settings_sections( 'recipe_hero_style_options' );
                    
                } else {
                
                    settings_fields( 'recipe_hero_labels_options' );
                    do_settings_sections( 'recipe_hero_labels_options' );
                    
                }
                
                submit_button();
            
            ?>
        </form>
        
    </div>
<?php
}

/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */ 

function recipe_hero_default_general_options() {
    
    $defaults = array(
        'page_home' => '',
        'per_page' => 10,
        'main_content_class' => '',
    );
    
    return apply_filters( 'recipe_hero_default_general_options', $defaults );
    
}

function recipe_hero_default_style_options() {
    
    $defaults = array(
        'disable_lightbox' => 0,
        'recipe_width'       =>  '',
        'recipe_padding'      =>  '',
        'center_container'    =>  0,
    );
    
    return apply_filters( 'recipe_hero_default_style_options', $defaults );
    
}

function recipe_hero_default_labels_options() {
    
    $defaults = array(
        'label_serves'     =>  '',
        'label_equipment'  =>  '',
        'label_prep'  =>  '',
        'label_cook'     =>  '',
    );
    
    return apply_filters( 'recipe_hero_default_labels_options', $defaults );
    
}

function recipe_hero_initialize_options() {

    if ( false == get_option( 'recipe_hero_general_options' ) ) {  
     
        add_option( 'recipe_hero_general_options', apply_filters( 'recipe_hero_default_general_options', recipe_hero_default_general_options() ) );
    
    }

    add_settings_section(
        'general_settings_section',
        __( 'General Options', 'recipe-hero' ),
        'recipe_hero_general_options_callback', 
        'recipe_hero_general_options'
    );
    
    add_settings_field(
        'rh-recipe-page-display',
        __( 'Recipe Page', 'recipe-hero' ),
        'recipe_hero_page_choice_callback',
        'recipe_hero_general_options',
        'general_settings_section'
    );

    add_settings_field( 
        'rh-recipe-per-page',                        
        __( 'Recipes Per Page', 'recipe-hero' ),                           
        'recipe_hero_per_page_callback',   
        'recipe_hero_general_options', 
        'general_settings_section'            
    );

    add_settings_field( 
        'rh-recipe-main-content-class',                        
        __( 'Main Content Class', 'recipe-hero' ),                           
        'recipe_hero_main_content_class_callback',   
        'recipe_hero_general_options', 
        'general_settings_section'            
    );
    
    register_setting(
        'recipe_hero_general_options',
        'recipe_hero_general_options'
    );
    
}
add_action( 'admin_init', 'recipe_hero_initialize_options' );


function recipe_hero_initialize_style_options() {

    if ( false == get_option( 'recipe_hero_style_options' ) ) {   

        add_option( 'recipe_hero_style_options', apply_filters( 'recipe_hero_default_style_options', recipe_hero_default_style_options() ) );
   
    }
    
    add_settings_section(
        'style_settings_section',
        __( 'Style Options', 'recipe-hero' ),
        'recipe_hero_style_options_callback',
        'recipe_hero_style_options'
    );

    add_settings_field( 
        'rh-recipe-disable-lightbox',                      
        __( 'Disable Lightbox', 'recipe-hero' ),              
        'recipe_hero_disable_lightbox_callback',   
        'recipe_hero_style_options',        
        'style_settings_section',         
        array(                              
            __( 'Selecting this will disable the lightbox used in Recipe Hero', 'recipe-hero' ),
        )
    );

    add_settings_field( 
        'rh-recipe-width',                        
        __( 'Recipe Width (px)', 'recipe-hero' ),                           
        'recipe_hero_recipe_width_callback',   
        'recipe_hero_style_options', 
        'style_settings_section'            
    );

    add_settings_field( 
        'rh-recipe-padding',                        
        __( 'Recipe Padding (px)', 'recipe-hero' ),                           
        'recipe_hero_recipe_padding_callback',   
        'recipe_hero_style_options', 
        'style_settings_section'            
    );

    add_settings_field( 
        'rh-recipe-center-container',                      
        __( 'Center Recipe Container', 'recipe-hero' ),              
        'recipe_hero_center_container_callback',   
        'recipe_hero_style_options',        
        'style_settings_section',         
        array(                              
            __( 'Selecting this will center the recipe in the middle of its container (experimental)', 'recipe-hero' ),
        )
    );
    
    register_setting(
        'recipe_hero_style_options',
        'recipe_hero_style_options'
    );
    
}
add_action( 'admin_init', 'recipe_hero_initialize_style_options' );

function recipe_hero_initialize_labels_options() {

    if ( false == get_option( 'recipe_hero_labels_options' ) ) {   
   
        add_option( 'recipe_hero_labels_options', apply_filters( 'recipe_hero_default_labels_options', recipe_hero_default_labels_options() ) );
   
    }

    add_settings_section(
        'labels_options_section',
        __( 'Custom Lables', 'recipe-hero' ),
        'recipe_hero_labels_options_callback',
        'recipe_hero_labels_options'
    );
    
    add_settings_field( 
        'rh-recipe-label-serves',                        
        __( '\'Serves\' Text', 'recipe-hero' ),                           
        'recipe_hero_label_serves_callback',   
        'recipe_hero_labels_options', 
        'labels_options_section'            
    );

    add_settings_field( 
        'rh-recipe-label-equipment',                        
        __( '\'Equipment\' Text', 'recipe-hero' ),                           
        'recipe_hero_label_equipment_callback',   
        'recipe_hero_labels_options', 
        'labels_options_section'            
    );

    add_settings_field( 
        'rh-recipe-label-prep',                        
        __( '\'Prep Time\' Text', 'recipe-hero' ),                           
        'recipe_hero_label_prep_callback',   
        'recipe_hero_labels_options', 
        'labels_options_section'            
    );

    add_settings_field( 
        'rh-recipe-label-cook',                        
        __( '\'Cook Time\' Text', 'recipe-hero' ),                           
        'recipe_hero_label_cook_callback',   
        'recipe_hero_labels_options', 
        'labels_options_section'            
    );

    register_setting(
        'recipe_hero_labels_options',
        'recipe_hero_labels_options'
    );

}
add_action( 'admin_init', 'recipe_hero_initialize_labels_options' );


function recipe_hero_general_options_callback() {
    echo '<p>' . __( 'Basic settings that relate to how the plugin functions.', 'recipe-hero' ) . '</p>';
}

function recipe_hero_style_options_callback() {
    echo '<p>' . __( 'Disable styles and add basic styling changes to the plugin.', 'recipe-hero' ) . '</p>';
}

function recipe_hero_labels_options_callback() {
    echo '<p>' . __( 'Change the output of certain parts of Recipe Hero.', 'recipe-hero' ) . '</p>';
    echo '<p>' . __( 'For more control over this, you should tranlate Recipe Hero.', 'recipe-hero' ) . '</p>';
}

/* Pages Callback */

function recipe_hero_page_choice_callback() {

    $options = get_option( 'recipe_hero_general_options' );

    $html = '<select id="page_home" name="recipe_hero_general_options[page_home]">';
        
        $args = wp_parse_args( array(
                'post_type'     => 'page',
                'numberposts'   => -1,
            ) );

        $posts = get_posts( $args );

        if ( isset ( $options['page_home'] ) ) {
            $set_page_home = $options['page_home'];
        } else {
            $set_page_home = '';
        }

        if ( $posts ) {
            foreach ( $posts as $post ) {
                $html .= '<option value="' . $post->ID . '" ' . selected( $set_page_home, $post->ID, false ) . '>' . $post->post_title .  '</option>';
            }
        }

    $html .= '</select>';

    $html .= '<p class="option-description">' . __( 'The page you select here will be the home of all your recipes. Additionally, the \'Recipe Archive\' of your site can be found at: ', 'recipe-hero' ) . '<code>' . site_url('/recipes/') . '</code></p>';

    echo $html;

}

function recipe_hero_per_page_callback() {
    
    $options = get_option( 'recipe_hero_general_options' );
    
    // Render the output
    echo '<input type="number" min="-1" id="per_page" class="numeric" name="recipe_hero_general_options[per_page]" value="' . $options['per_page'] . '" />';
    echo '<p class="option-description">' . __( 'This will only apply for the recipe page, selected in the option above. Other recipe archives use the default posts per page setting.', 'recipe-hero' ) . '</p>';

}

function recipe_hero_main_content_class_callback() {
    
    $options = get_option( 'recipe_hero_general_options' );

    if ( isset( $options['main_class_content'] ) ) {
        $main_class_content = $options['main_class_content'];
    } else {
        $main_class_content = '';
    }
    
    // Render the output
    echo '<input type="text" size="15" id="main_class_content" name="recipe_hero_general_options[main_class_content]" value="' . $main_class_content . '" placeholder="eg. .site-content" />';
    echo '<p class="option-description">' . __( 'The wrapper class for the content area. This is needed if your theme only applies styles inside of this class.', 'recipe-hero' ) . '</p>';

}

function recipe_hero_disable_lightbox_callback($args) {
    
    $options = get_option('recipe_hero_style_options');
    
    $html = '<input type="checkbox" id="disable_lightbox" name="recipe_hero_style_options[disable_lightbox]" value="1" ' . checked( 1, isset( $options['disable_lightbox'] ) ? $options['disable_lightbox'] : 0, false ) . '/>'; 
    $html .= '<label for="disable_lightbox">&nbsp;'  . $args[0] . '</label>'; 
    
    echo $html;
    
}

function recipe_hero_recipe_width_callback() {
    
    $options = get_option( 'recipe_hero_style_options' );

    if ( isset( $options['recipe_width'] ) ) {
        $recipe_width = $options['recipe_width'];
    } else {
        $recipe_width = '';
    }
    
    // Render the output
    echo '<input type="text" size="15" id="recipe_width" name="recipe_hero_style_options[recipe_width]" value="' . $recipe_width . '" placeholder="eg. 600px or 90%" />';
    echo '<p class="option-description">' . __( 'The width of the recipe. This can also be a %, like 90%.', 'recipe-hero' ) . '</p>';

}

function recipe_hero_recipe_padding_callback() {
    
    $options = get_option( 'recipe_hero_style_options' );

    if ( isset( $options['recipe_padding'] ) ) {
        $recipe_padding = $options['recipe_padding'];
    } else {
        $recipe_padding = '';
    }
    
    // Render the output
    echo '<input type="text" size="15" id="recipe_padding" name="recipe_hero_style_options[recipe_padding]" value="' . $recipe_padding . '" placeholder="eg. 15px or 10px 0 5px" />';
    echo '<p class="option-description">' . __( 'Sometimes you may want to add some padding around the recipe articles. Normally from 0-25px is enough.', 'recipe-hero' ) . '</p>';

}

function recipe_hero_center_container_callback($args) {
    
    $options = get_option('recipe_hero_style_options');
    
    $html = '<input type="checkbox" id="center_container" name="recipe_hero_style_options[center_container]" value="1" ' . checked( 1, isset( $options['center_container'] ) ? $options['center_container'] : 0, false ) . '/>'; 
    $html .= '<label for="center_container">&nbsp;'  . $args[0] . '</label>'; 
    
    echo $html;
    
}

function recipe_hero_label_serves_callback() {
    
    $options = get_option( 'recipe_hero_labels_options' );

    if ( isset( $options['label_serves'] ) ) {
        $label_serves = $options['label_serves'];
    } else {
        $label_serves = '';
    }
    
    // Render the output
    echo '<input type="text" size="15" id="label_serves" name="recipe_hero_labels_options[label_serves]" value="' . $label_serves . '" placeholder="Serves" />';
    echo '<p class="option-description">' . __( '', 'recipe-hero' ) . '</p>';

}

function recipe_hero_label_equipment_callback() {
    
    $options = get_option( 'recipe_hero_labels_options' );

    if ( isset( $options['label_equipment'] ) ) {
        $label_equipment = $options['label_equipment'];
    } else {
        $label_equipment = '';
    }
    
    // Render the output
    echo '<input type="text" size="15" id="label_equipment" name="recipe_hero_labels_options[label_equipment]" value="' . $label_equipment . '" placeholder="Equipment" />';
    echo '<p class="option-description">' . __( '', 'recipe-hero' ) . '</p>';

}

function recipe_hero_label_prep_callback() {
    
    $options = get_option( 'recipe_hero_labels_options' );

    if ( isset( $options['label_prep'] ) ) {
        $label_prep = $options['label_prep'];
    } else {
        $label_prep = '';
    }
    
    // Render the output
    echo '<input type="text" size="15" id="label_prep" name="recipe_hero_labels_options[label_prep]" value="' . $label_prep . '" placeholder="Prep Time" />';
    echo '<p class="option-description">' . __( '', 'recipe-hero' ) . '</p>';

}

function recipe_hero_label_cook_callback() {
    
    $options = get_option( 'recipe_hero_labels_options' );

    if ( isset( $options['label_cook'] ) ) {
        $label_cook = $options['label_cook'];
    } else {
        $label_cook = '';
    }
    
    // Render the output
    echo '<input type="text" size="15" id="label_cook" name="recipe_hero_labels_options[label_cook]" value="' . $label_cook . '" placeholder="Cook Time" />';
    echo '<p class="option-description">' . __( '', 'recipe-hero' ) . '</p>';

}