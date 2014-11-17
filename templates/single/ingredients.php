<?php
/**
 * Recipe Single Ingredients
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$ingredients = get_post_meta( $post->ID, '_recipe_hero_ingredients_group', true );

// Check if any ingredients exist
if ( ( $ingredients[0]['quantity'] ) ) { ?>

	<div class="recipe-single-ingredients">

		<h4 class="inredients-heading">
			<?php _e( 'Ingredients', 'recipe-hero' ); ?>
		</h4>

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

		   	<li class="ingredients-item" itemprop="ingredients">
		   		<?php echo $ingredient_amount; ?> 
		   		<?php echo $ingredient_name; ?> 
		    </li>

		<?php
		}
		?>
		</ul>

	<hr class="recipe-single-seperator" />

	</div><!-- .recipe-single-ingredients -->

<?php }