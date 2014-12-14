<?php
/**
 * Recipe Single Ingredients
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.3
 * @todo      Move functionaility into template parts and hook it in
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$ingredients = get_post_meta( $post->ID, '_recipe_hero_ingredients_group', true );
$ingredients = array_filter( $ingredients );

// Check if any ingredients exist
if ( isset( $ingredients[0]['name'] ) ) { ?>

	<div class="recipe-single-ingredients">

		<h4 class="inredients-heading">
			<?php _e( 'Ingredients', 'recipe-hero' ); ?>
		</h4>

		<?php do_action( 'recipe_hero_before_ingredients_list' ); ?>

		<ul class="ingredients-list">

		<?php foreach ( (array) $ingredients as $key => $ingredient ) {

		    $ingredient_quantity = $ingredient_amount = $ingredient_name = '';

		    if ( isset( $ingredient['quantity'] ) && isset( $ingredient['amount'] ) ) {

		        $ingredient_quantity = $ingredient['quantity'];
		        $ingredient_amount_pre = $ingredient['amount'];
		    	$ingredient_amount = recipe_hero_output_single_ingredient_amount( $ingredient_amount_pre, $ingredient_quantity );
		  	
		  	}

		    if ( isset( $ingredient['name'] ) ) {  

		        $ingredient_name = $ingredient['name'];
		        
		    }

		   	?>

		   	<li class="ingredients-item <?php echo rh_format_string( $ingredient_name ); ?>" itemprop="ingredients">

		   		<?php do_action( 'recipe_hero_before_ingredients_list_item' ); ?>

		   		<div class="amount">
		   			<?php echo $ingredient_amount; ?>
		   		</div>
		   		<div class="name">
		   			<?php echo $ingredient_name; ?>
		   		</div>

		   		<?php do_action( 'recipe_hero_after_ingredients_list_item' ); ?>

		    </li>

		<?php } ?>

		</ul>

		<?php do_action( 'recipe_hero_after_ingredients_list' ); ?>

	<hr class="recipe-single-seperator" />

	</div><!-- .recipe-single-ingredients -->

<?php }