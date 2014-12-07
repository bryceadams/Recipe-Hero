<?php
/**
 * Functions to load admin scripts / styles
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Recipe_Hero_Admin_Scripts {

	/**
	 * Constructor
	 */
	public function __construct () {

		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
		
		add_action( 'admin_head', array( $this, 'initialize_numeric_js' ) );
		add_action( 'admin_head', array( $this, 'initialize_autocomplete_js' ) );

	}

	/**
	 * Register/queue frontend scripts.
	 *
	 * @access public
	 * @return void
	 * @todo include script_debug mode $min
	 * @todo conditionally load on the specific recipe hero pages
	 */
	public function load_scripts() {

		// Register all scripts/styles for later use
		wp_register_script( 'numeric', RH()->plugin_url() . '/assets/admin/js/jquery.numeric.js', array( 'jquery' ), RecipeHero::$version, true );
		wp_register_script( 'liquidmetal', RH()->plugin_url() . '/assets/admin/js/liquidmetal.js', array( 'jquery' ), RecipeHero::$version, true );
		wp_register_script( 'recipe-ordering', RH()->plugin_url() . '/assets/admin/js/recipe-ordering.js', array( 'jquery', 'jquery-ui-sortable' ), RecipeHero::$version, true );

		wp_register_script( 'rh-admin-meta-boxes-gallery', RH()->plugin_url() . '/assets/admin/js/meta-boxes-gallery.js', array( 'jquery', 'jquery-ui-sortable', 'tiptip' ), RecipeHero::$version, true );

		wp_register_script( 'tiptip', RH()->plugin_url() . '/assets/admin/js/jquery-tiptip/jquery.tipTip.min.js', array( 'jquery' ), RecipeHero::$version, true );
		wp_register_style( 'tiptip-css', RH()->plugin_url() . '/assets/admin/css/tiptip.css' );

		wp_register_script( 'select2', RH()->plugin_url() . '/assets/admin/js/jquery-select/select2.min.js', array( 'jquery' ), RecipeHero::$version, true );
		wp_register_style( 'select2-css', RH()->plugin_url() . '/assets/admin/css/select2.css' );

		wp_register_script( 'rh-admin-js', RH()->plugin_url() . '/assets/admin/js/admin.js', array( 'jquery', 'numeric', 'liquidmetal', 'tiptip', 'select2' ), RecipeHero::$version, true );
		wp_register_style( 'rh-admin-css', RH()->plugin_url() . '/assets/admin/css/admin.css' );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'numeric' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'liquidmetal' );
		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'tiptip' );
		wp_enqueue_style( 'tiptip-css' );

		wp_enqueue_script( 'select2' );
		wp_enqueue_style( 'select2-css' );

		wp_enqueue_script( 'rh-admin-js' );
		wp_enqueue_style( 'rh-admin-css' );

		wp_enqueue_script( 'rh-admin-meta-boxes-gallery' );

	}


	/**
	 * Initialized Numeric JS
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  0.7.0
	 */

	public function initialize_numeric_js() { ?>

		<script type="text/javascript">

			jQuery(document).ready(function() {

				jQuery(".numeric").numeric();

			});

		</script>

	<?php
	}


	/**
	 * Initialized autocomplete JS
	 *
	 * @package   Recipe Hero
	 * @author    Captain Theme <info@captaintheme.com>
	 * @since 	  0.9.0
	 */

	public function initialize_autocomplete_js() { ?>

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

new Recipe_Hero_Admin_Scripts();