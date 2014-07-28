<?php
/**
 * Functions to load admin scripts / styles
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  0.9.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Recipe_Hero_Admin_Scripts {

	/**
	 * Constructor
	 */
	public function __construct () {
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	/**
	 * Register/queue frontend scripts.
	 *
	 * @access public
	 * @return void
	 */
	public function load_scripts() {

		global $post, $wp;

		// Register all scripts/styles for later use
		wp_register_script( 'numeric', plugins_url( '../assets/js/jquery.numeric.js', __FILE__ ), array( 'jquery' ), RECIPE_HERO_VERSION_NUMBER, true );
		wp_register_script( 'liquidmetal', plugins_url( '../assets/js/liquidmetal.js', __FILE__ ), array( 'jquery' ), RECIPE_HERO_VERSION_NUMBER, true );		
		wp_register_script( 'chosen', plugins_url( '../assets/js/jquery.chosen.min.js', __FILE__ ), array( 'jquery' ), RECIPE_HERO_VERSION_NUMBER, true );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'numeric' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'liquidmetal' );
		wp_enqueue_script( 'chosen' );
		
	}


}

new Recipe_Hero_Admin_Scripts();


/**
 * Initialized Numeric JS
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 */

if ( ! function_exists( 'recipe_hero_initialize_admin_numeric_js' ) ) {

	function recipe_hero_initialize_admin_numeric_js() { ?>

		<script type="text/javascript">

			jQuery(document).ready(function() {

				jQuery(".numeric").numeric();

			});

		</script>

	<?php
	}

}
add_action( 'admin_head', 'recipe_hero_initialize_admin_numeric_js' );


/**
 * Initialized autocomplete JS
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.9.0
 */

if ( ! function_exists( 'recipe_hero_initialize_admin_autocomplete_js' ) ) {

	function recipe_hero_initialize_admin_autocomplete_js() { ?>

		<script type="text/javascript">

			jQuery(document).ready(function() {

				jQuery(function($) {
			        var data = [
			        	<?php

			        	$ingredients = recipe_hero_sitewide_all_ingredients();

			        	foreach ( ( array ) $ingredients as $key => $ingredient ) {

				            echo '"' . $ingredient . '",';

				        }

				        ?>
			        ];
			        // Also going to use LiquidMetal for better auto-completing
			        $("#_recipe_hero_ingredients_group_repeat .ingredient_name_field").live('focus', function() {
			        
				        $("#_recipe_hero_ingredients_group_repeat .ingredient_name_field").autocomplete({
				            source: data, minLength: 0, delay: 0, source: function(request, response ) { 
								var arr;

								if(request.term == "")  {
								return response(data);
								}

								arr = $.map(data, function(value) {
									var score = LiquidMetal.score(value, request.term);
									if(score < 0.5) {
									  return null; // jQuery.map compacts null values
									}
									return { 'value': value, 'score': LiquidMetal.score(value, request.term) };
								});

								arr = arr.sort(function(a,b) { return a['score'] < b['score'] }) ;
							  	return response( $.map(arr, function(value) { return  value['value']; }) );
							} 
						});

					});

				});

			});

		</script>

	<?php
	}

}
add_action( 'admin_head', 'recipe_hero_initialize_admin_autocomplete_js' );

/**
 * Initialized Chosen JS
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.9.0
 */

if ( ! function_exists( 'recipe_hero_initialize_admin_chosen_js' ) ) {

	function recipe_hero_initialize_admin_chosen_js() { ?>

		<script type="text/javascript">

			jQuery(document).ready(function() {

				jQuery(".chosen").chosen({disable_search_threshold: 5, no_results_text: "Oops, no page found!", width: "25%"});

			});

		</script>

	<?php
	}

}
add_action( 'admin_head', 'recipe_hero_initialize_admin_chosen_js' );
