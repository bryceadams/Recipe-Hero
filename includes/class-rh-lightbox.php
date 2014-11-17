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

class Recipe_Hero_Lightbox {

    function __construct() {
 
 		//add_action( 'wp_head', array( $this, 'initialize_lightbox_js' ) );

    }

    /**
	 * Initialized Lightbox JS
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  0.8.0
	 */

	public function initialize_lightbox_js() {

		if ( get_option( 'recipe_hero_enable_lightbox' ) == '' || get_option( 'recipe_hero_enable_lightbox' ) == 'yes' ) {

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
						jQuery('.recipe-gallery').magnificPopup({ 
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

new Recipe_Hero_Lightbox;