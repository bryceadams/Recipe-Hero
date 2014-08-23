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

	function recipe_hero_convert_minute_hour($time, $format = '%dh %02dm') {

	    settype($time, 'integer');
	    if ($time < 1) {
	        return;
	    }
	    $hours = floor($time / 60);
	    $minutes = $time % 60;
	    return sprintf($format, $hours, $minutes);

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

		if ( $ingredient_quantity == 1 ) {
			$plural = '';
		} else {
			$plural = 's';
		}

		switch ( $ingredient_amount_pre ) {
		    case 'gm':
		    	$ingredient_amount = __( 'Gram', 'recipe-hero' ) . $plural;
		    	break;
		    case 'oz':
		    	$ingredient_amount = __( 'Ounce', 'recipe-hero' ) . $plural;
		    	break;
		    case 'ml':
		    	$ingredient_amount = __( 'Milliliter', 'recipe-hero' ) . $plural;
		    	break;
		    case 'ts':
		    	$ingredient_amount = __( 'Teaspoon', 'recipe-hero' ) . $plural;
		    	break;
		    case 'tas':
		    	$ingredient_amount = __( 'Tablespoon', 'recipe-hero' ) . $plural;
		    	break;
		    case 'cup':
		    	$ingredient_amount = __( 'Cup', 'recipe-hero' ) . $plural;
		    	break;
		    case 'lt':
		    	$ingredient_amount = __( 'LIter', 'recipe-hero' ) . $plural;
		    	break;
		    case 'lb':
		    	$ingredient_amount = __( 'Pound', 'recipe-hero' ) . $plural;
		    	break;
		    case 'kg':
		    	$ingredient_amount = __( 'Kilogram', 'recipe-hero' ) . $plural;
		    	break;
		    case 'slice':
		    	$ingredient_amount = __( 'Slice', 'recipe-hero' ) . $plural;
		    	break;
		    case 'piece':
		    	$ingredient_amount = __( 'Piece', 'recipe-hero' ) . $plural;
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