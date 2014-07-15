<?php
/**
 * Recipe Search Results Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Search Results Header
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.1
 */		

if ( ! function_exists( 'recipe_hero_output_search_header' ) ) {

	function recipe_hero_output_search_header() {

		if ( is_search() ) { ?>

			 <header class="page-header">
				<h1 class="page-title">
					<?php printf( __( 'Search Results for: %s', 'recipe-hero' ), get_search_query() ); ?>
				</h1>
			</header><!-- .page-header -->
		
		<?php }

	}

}