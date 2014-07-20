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

/**
 * Initialized Lightbox JS
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_initialize_lightbox_js' ) ) {

	function recipe_hero_initialize_lightbox_js() {

		global $rh_style_options;

		if ( ! $rh_style_options['disable_lightbox'] ) {

			if ( ( get_post_type() == 'recipe' ) && is_single() ) { ?>

				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('.steps-image-link').magnificPopup({ 
						  type: 'image',
						   gallery: {
							    // options for gallery
							    enabled: true
							  },
							  image: {
							    // options for image content type
							    titleSrc: 'title'
							  }
						});
					});

				</script>

			<?php }

		}

	}

}
add_action( 'wp_head', 'recipe_hero_initialize_lightbox_js' );