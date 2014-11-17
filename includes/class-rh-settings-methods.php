<?php
/**
 * Functions that run because of the Recipe Hero Core Settings
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Recipe_Hero_Settings_Methods {

    function __construct() {
 
    	add_action( 'wp_enqueue_scripts', array( $this, 'option_enable_lightbox' ), 9999 );
		add_filter( 'comments_open', array( $this, 'override_comments_open' ), 1000);
		add_action( 'wp_head', array( $this, 'option_styles' ) );

    }

    /**
	 * Disable Lightbox
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  0.8.0
	 */

	public function option_enable_lightbox() {

		if ( get_option( 'recipe_hero_enable_lightbox' ) == '' || get_option( 'recipe_hero_enable_lightbox' ) == 'yes' ) {

			if ( ( get_post_type() == 'recipe' ) && is_single() ) {

				wp_enqueue_script( 'magnific' );
				wp_enqueue_script( 'rh-lightbox' );
				wp_enqueue_style( 'magnific-css' );

			}

		}

	}

	/**
	 * Specified Recipe Home Page - Hide Comments (if turned on)
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  0.8.0
	 */

	public function override_comments_open( $close ) {

		global $post;

		if ( isset( $rh_general_options['page_home'] ) ) {
            $rh_home_id = $rh_general_options['page_home'];
        }

	    if ( isset( $rh_home_id ) ) {
			if ( $post->ID == $rh_home_id ) {
				$close = false;
			}
		}
		
	    return $close;

	}

	/**
	 * Basic Styling Options
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  0.7.0
	 * @todo 	  Make rules smarter - if 'px' needed but not given, append it, etc.
	 */

	public function option_styles() {

		global $rh_style_options;

		if ( isset ( $rh_style_options['recipe_width'] ) ) {
			$width = $rh_style_options['recipe_width'];
		}

		if ( isset ( $rh_style_options['recipe_padding'] ) ) {
			$padding = $rh_style_options['recipe_padding'];
		}

		if ( isset ( $rh_style_options['center_container'] ) ) {
			$center = $rh_style_options['center_container'];
		}

		?>

		<style type="text/css">

			<?php if ( $width ) { ?>

				article {
					width: <?php echo $width; ?>;
				}

			<?php } ?>

			<?php if ( $padding ) { ?>


				article.recipe,
				.recipe-archive-tax-header,
				.single-recipe #comments,
				.recipe-search article,
				.recipe-search header.page-header {
					padding: <?php echo $padding; ?>;
				}

			<?php } ?>

			<?php if ( $center ) { ?>

				article {
					margin: 0 auto;
				}

			<?php } ?>

		</style>

	<?php }

}

new Recipe_Hero_Settings_Methods;