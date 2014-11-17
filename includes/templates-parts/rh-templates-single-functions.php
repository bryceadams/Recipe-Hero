<?php
/**
 * Recipe Single Template Display Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Recipe Title
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_single_title' ) ) {
	
	function recipe_hero_output_single_title() {

		recipe_hero_get_template( 'single/title.php' );

	}

}

/**
 * Recipe Meta: Author & Date
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 * @todo 	  Make 'By' fitlerable / an option
 */

if ( ! function_exists( 'recipe_hero_output_single_meta' ) ) {

	function recipe_hero_output_single_meta() {

		recipe_hero_get_template( 'single/meta.php' );
		
	}

}

/**
 * Recipe Featured Image Photo
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_single_photo' ) ) {

	function recipe_hero_output_single_photo() {

		recipe_hero_get_template( 'single/photo.php' );

	}

}

/**
 * Recipe Gallery Thumbnails
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_single_thumbnails' ) ) {

	function recipe_hero_output_single_thumbnails() {

		recipe_hero_get_template( 'single/gallery.php' );

	}

}

/**
 * Recipe Cuisine / Course
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.6.0
 * @todo 	  Make 'By' fitlerable / an option
 */

if ( ! function_exists( 'recipe_hero_output_single_tax' ) ) {

	function recipe_hero_output_single_tax() {

		recipe_hero_get_template( 'single/category.php' );

	}

}

/**
 * Recipe Details / Information
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_single_details' ) ) {

	function recipe_hero_output_single_details() {

		recipe_hero_get_template( 'single/details.php' );

	}

}

/**
 * Recipe Content / Description
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.6.0
 */

if ( ! function_exists( 'recipe_hero_output_single_description' ) ) {

	function recipe_hero_output_single_description() {

		recipe_hero_get_template( 'single/description.php' );

	}

}

/**
 * Recipe Ingredients
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.6.0
 * @todo 	  For the css3 columns being used to display, need to add javacript support (https://github.com/BetleyWhitehorne/CSS3MultiColumn)
 */

if ( ! function_exists( 'recipe_hero_output_single_ingredients' ) ) {

	function recipe_hero_output_single_ingredients() {

		recipe_hero_get_template( 'single/ingredients.php' );

	}

}

/**
 * Recipe Instructions / Steps
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.6.0
 */

if ( ! function_exists( 'recipe_hero_output_single_instructions' ) ) {

	function recipe_hero_output_single_instructions() {

		recipe_hero_get_template( 'single/instructions.php' );

	}

}

/**
 * Recipe Nutrition Info
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_single_nutrition' ) ) {

	function recipe_hero_output_single_nutrition() {

		recipe_hero_get_template( 'single/nutrition.php' );

	}

}

/**
 * Recipe Comments
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_single_comments' ) ) {

	function recipe_hero_output_single_comments() {

		recipe_hero_get_template( 'single/comments.php' );

	}

}

/******************************/


/**
 * Line Break
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_output_single_seperator' ) ) {

	function recipe_hero_output_single_seperator() {

		echo '<hr class="recipe-single-seperator" />';

	}

}

/**
 * Function to convert minutes to hours for prep/cook time
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_convert_minute_hour' ) ) {

	function recipe_hero_convert_minute_hour( $time, $format = '%dh %02dm' ) {

	    settype( $time, 'integer' );
	    if ( $time < 1 ) {
	        return;
	    }
	    $hours = floor( $time / 60 );
	    $minutes = $time % 60;
	    
	    if ( $time < 60 ) {
	    	$content = $minutes . 'm';
	    } else {
	   		$content = sprintf( $format, $hours, $minutes );
	    }

	    return $content;

	}

}

/**
 * Function to calculate total prep/cook time
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! function_exists( 'recipe_hero_calc_total_cook_time' ) ) {

	function recipe_hero_calc_total_cook_time() {

		// Variables
		global $post;
		$prep_time 	= (int) ( get_post_meta ( $post->ID, '_recipe_hero_detail_prep_time', true ) );
		$cook_time 	= (int) ( get_post_meta ( $post->ID, '_recipe_hero_detail_cook_time', true ) );

		$total_time = $prep_time + $cook_time;

		return $total_time;

	}

}

/**
 * Small Function for Determing Ingredient Amount
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 * @todo 	  Not sure what to do about translations and plurals here.
 */

if ( ! function_exists( 'recipe_hero_output_single_ingredient_amount' ) ) {

	function recipe_hero_output_single_ingredient_amount( $ingredient_amount_pre, $ingredient_quantity ) {

		switch ( $ingredient_amount_pre ) {
		    case 'gm':
		    	$ingredient_amount = sprintf( _n( '1 Gram', '%s Grams', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'oz':
		    	$ingredient_amount = sprintf( _n( '1 Ounce', '%s Ounces', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'ml':
		    	$ingredient_amount = sprintf( _n( '1 Millilitre', '%s Millilitres', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'ts':
		    	$ingredient_amount = sprintf( _n( '1 Teaspoon', '%s Teaspoons', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'tas':
		    	$ingredient_amount = sprintf( _n( '1 Tablespoon', '%s Tablespoons', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'cup':
		    	$ingredient_amount = sprintf( _n( '1 Cup', '%s Cups', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'lt':
		    	$ingredient_amount = sprintf( _n( '1 Liter', '%s Liters', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'lb':
		    	$ingredient_amount = sprintf( _n( '1 Pound', '%s Pounds', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'kg':
		    	$ingredient_amount = sprintf( _n( '1 Kilogram', '%s Kilograms', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'slice':
		    	$ingredient_amount = sprintf( _n( '1 Slice', '%s Slices', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'piece':
		    	$ingredient_amount = sprintf( _n( '1 Piece', '%s Pieces', $ingredient_quantity, 'recipe-hero' ), $ingredient_quantity );
		    	break;
		    case 'none':
		    	$ingredient_amount = '';
		    	break;
		    default :
		    	$ingredient_amount = '';
		    	break;
	   	}

	   	return $ingredient_amount;

	}

}