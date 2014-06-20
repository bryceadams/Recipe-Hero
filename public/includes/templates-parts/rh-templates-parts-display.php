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

/**
 * Recipe Title
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_title() {

	// Variables
	global $post;
	$get_title = get_the_title( $post->ID );

	$title = '<h2 class="recipe-single-title" itemprop="name">';
	$title .= $get_title;
	$title .= '</h2>';

	echo $title;

}

/**
 * Recipe Author
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 * @todo 	  Make 'By' fitlerable / an option
 */

function recipe_hero_output_single_author() {

	// Variables
	$get_author = get_the_author();

	$author = '<h5 class="recipe-single-author">By <span itemprop="author">';
	$author .= $get_author;
	$author .= '</span></h5>';

	echo $author;

}

/**
 * Recipe Cuisine / Course / Date
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 * @todo 	  Make 'By' fitlerable / an option
 */

function recipe_hero_output_single_meta() {

	// Variables
	global $post;

	$date = get_the_date();

	$cuisine_terms = wp_get_object_terms($post->ID, 'cuisine');
		if(!empty($cuisine_terms)){
			if(!is_wp_error( $cuisine_terms )){
				$cuisine = '<ul>';
				foreach($cuisine_terms as $term){
					$cuisine .= '<li><a href="'.get_term_link($term->slug, 'cuisine').'">'.$term->name.'</a></li>'; 
				}
				$cuisine .= '</ul>';
			}
		}

	$course_terms = wp_get_object_terms($post->ID, 'course');
		if(!empty($course_terms)){
			if(!is_wp_error( $course_terms )){
				$course = '<ul>';
				foreach($course_terms as $term){
					$course .= '<li><a href="'.get_term_link($term->slug, 'course').'">'.$term->name.'</a></li>'; 
				}
				$course .= '</ul>';
			}
		}

		?>

	<div class="recipe-single-meta">

		<div class="date">
			Posted: <?php echo $date; ?>
		</div>

		<div class="cuisine">
			<?php if ( isset( $cuisine ) ) { ?>
				Cuisines: <?php echo $cuisine; ?>
			<?php } ?>
		</div>

		<div class="course">
			<?php if ( isset ( $course ) ) { ?>
				Course: <?php echo $course; ?>
			<?php } ?>
		</div>

	</div>

<?php
}

/**
 * Recipe Details / Information
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_details() {

	// Variables
	global $post;
	$serves 	= get_post_meta( $post->ID, '_recipe_hero_detail_serves', true );
	$prep_time 	= get_post_meta ( $post->ID, '_recipe_hero_detail_prep_time', true );
	$cook_time 	= get_post_meta ( $post->ID, '_recipe_hero_detail_cook_time', true );
	$equipment 	= get_post_meta ( $post->ID, '_recipe_hero_detail_equipment', false );
	$nutrition 	= get_post_meta ( $post->ID, '_recipe_hero_detail_nutrition', true ); ?>

	<div class="recipe-single-details">

		<h4 class="details-heading">Recipe Details</h4>

		<div class="serves">
			<strong>Serves:</strong> <span itemprop="recipeYield"><?php echo $serves; ?> People</span>
		</div>

		<div class="prep-time">
			<strong>Preparation Time:</strong> <meta itemprop="prepTime" content="<?php echo recipe_hero_schema_prep_time(); ?>"><?php echo $prep_time; ?>
		</div>

		<div class="cook-time">
			<strong>Cook Time:</strong> <meta itemprop="cookTime" content="<?php echo recipe_hero_schema_cook_time(); ?>"> <?php echo $cook_time; ?>
		</div>

		<div class="equipment">
			<strong>Equipment:</strong>
			<?php
			foreach ($equipment as $equipment_item ) {
				foreach($equipment_item as $item) {
				    echo '<div class="equipment-item">';
				    echo $item;
				    echo '</div>';
				}
			}
			?>
		</div>

		<div class="nutrition" itemprop="nutrition" itemscope itemtype="http://schema.org/NutritionInformation">
			<strong>Nutrition:</strong> <?php echo $nutrition; ?>
		</div>

	</div><!-- .recipe-single-details -->

<?php
}

/**
 * Recipe Ingredients
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_ingredients() {

	// Variables
	global $post;
	$ingredients = get_post_meta( $post->ID, '_recipe_hero_ingredients_group', true );

	echo '<div class="recipe-single-ingredients">';

		echo '<h4 class="ingredients-heading">Ingredients</h4>';

		echo '<ul class="ingredients-list">';
		foreach ( (array) $ingredients as $key => $ingredient ) {

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

		    echo '<li class="ingredients-item" itemprop="ingredeints">';
		    echo $ingredient_quantity . ' ';
		    echo $ingredient_amount . ' ';
		    echo $ingredient_name;
		    echo '</li>';

		}
		echo '</ul>';

	echo '</div><!-- .recipe-single-ingredients -->';

}

/**
 * Recipe Instructions / Steps
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_instructions() {

	// Variables
	global $post;
	$instructions = get_post_meta( $post->ID, '_recipe_hero_steps_group', true );

	echo '<div class="recipe-single-instructions">';

		echo '<h4 class="instructions-heading">Instructions</h4>';

		echo '<ol class="steps-list" itemprop="recipeInstructions">';
		foreach ( (array) $instructions as $key => $instruction ) {

		    $ingredient_quantity = $ingredient_amount = $ingredient_name = '';

		    if ( isset( $instruction['_recipe_hero_step_instruction'] ) ) {
		        $instruction_text = $instruction['_recipe_hero_step_instruction'];
		    }

		    if ( isset( $instruction['_recipe_hero_step_image'] ) ) {
		    	$instruction_image = '<img src="' . $instruction['_recipe_hero_step_image'] . '" class="step-image" />';
		  	}

		    echo '<li class="steps-item" itemprop="ingredeints">';
		    echo wpautop( $instruction_text ) . ' ';
		    echo $instruction_image;
		    echo '</li>';

		}
		echo '</ul>';

	echo '</div><!-- .recipe-single-ingredients -->';

}


/******************************/


// Small Function for Determing Ingredient Amount
function recipe_hero_output_single_ingredient_amount( $ingredient_amount_pre, $ingredient_quantity ) {

	if ( $ingredient_quantity == 1 ) {
		$plural = '';
	} else {
		$plural = 's';
	}

	switch ( $ingredient_amount_pre ) {
	    case 'gm':
	    	$ingredient_amount = 'Gram' . $plural;
	    	break;
	    case 'oz':
	    	$ingredient_amount = 'Ounce' . $plural;
	    	break;
	    case 'ml':
	    	$ingredient_amount = 'Milliliter' . $plural;
	    	break;
	    case 'ts':
	    	$ingredient_amount = 'Teaspoon' . $plural;
	    	break;
	    case 'tas':
	    	$ingredient_amount = 'Tablespoon' . $plural;
	    	break;
	    case 'cup':
	    	$ingredient_amount = 'Cup' . $plural;
	    	break;
	    case 'lt':
	    	$ingredient_amount = 'LIter' . $plural;
	    	break;
	    case 'lb':
	    	$ingredient_amount = 'Pound' . $plural;
	    	break;
	    case 'kg':
	    	$ingredient_amount = 'Kilogram' . $plural;
	    	break;
	    case 'slice':
	    	$ingredient_amount = 'Slice' . $plural;
	    	break;
	    case 'piece':
	    	$ingredient_amount = 'Piece' . $plural;
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