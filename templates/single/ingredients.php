<?php
/**
 * Recipe Single Ingredients
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$ingredients = get_post_meta( $post->ID, '_recipe_hero_ingredients_group', true ); ?>

<!-- if ( isset ( $ingredients[0]['_recipe_hero_ingredient_quantity'] ) ) { -->

<div class="recipe-single-ingredients">

	<h4 class="inredients-heading">
		<?php _e( 'Ingredients', 'recipe-hero' ); ?>
	</h4>

	<ul class="ingredients-list">

	<?php foreach ( (array) $ingredients as $key => $ingredient ) {

	    $ingredient_quantity = $ingredient_amount = $ingredient_name = '';

	    if ( isset( $ingredient['quantity'] ) ) {

	        $ingredient_quantity = $ingredient['quantity'];

	    }

	    if ( isset( $ingredient['amount'] ) ) {

	        $ingredient_amount_pre = $ingredient['amount'];
	    	
	    	$ingredient_amount = recipe_hero_output_single_ingredient_amount( $ingredient_amount_pre, $ingredient_quantity );
	  	
	  	}

	    if ( isset( $ingredient['name'] ) ) {  

	        $ingredient_name = $ingredient['name'];
	        
	    }

	   	?>

	   	<li class="ingredients-item" itemprop="ingredients">
	   		<?php $ingredient_quantity; ?> 
	    	<?php echo $ingredient_amount; ?> 
	    	<?php echo $ingredient_name; ?> 
	    </li>

	<?php
	}
	?>
	</ul>

<hr class="recipe-single-seperator" />

</div><!-- .recipe-single-ingredients -->

<!-- } -->