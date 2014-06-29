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
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_output_single_title' ) ) {
	
	function recipe_hero_output_single_title() {

		// Variables
		global $post;
		$get_title = get_the_title( $post->ID );

		$title = '<h1 class="recipe-single-title ' . recipe_hero_class_recipe_title() . '" itemprop="name">';
		$title .= $get_title;
		$title .= '</h1>';

		echo $title;

	}

}

/**
 * Recipe Meta: Author & Date
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.6.0
 * @todo 	  Make 'By' fitlerable / an option
 */

if ( ! function_exists( 'recipe_hero_output_single_meta' ) ) {

	function recipe_hero_output_single_meta() {

		// Variables
		$date = get_the_date();
		?>

		<div class="recipe-single-meta">

			<div class="date updated">
				<meta itemprop="datePublished" content="<?php echo get_the_date( 'c' ); ?>">
				<span class="dashicons dashicons-clock"></span> <?php echo $date; ?>
			</div>
			<div class="vcard author" itemprop="author">
				<span class="dashicons dashicons-admin-users"></span> <span class="fn"><?php echo the_author_posts_link(); ?></span>
			</div>
			<div class="comments-link">
				 <meta itemprop="interactionCount" content="UserComments:<?php comments_number( '0', '1','%' ); ?>" />
				<span class="dashicons dashicons-testimonial"></span> <a href="#comments"><?php comments_number( __( '0 Comments', 'recipe-hero' ), __( '1 Comment', 'recipe-hero' ), __( '% Comments', 'recipe-hero' ) ); ?></a>
			</div>
			<?php if ( get_edit_post_link() ) { ?>
				<div class="edit-link">
					<span class="dashicons dashicons-welcome-write-blog"></span> <?php edit_post_link( __( 'Edit Recipe', 'recipe-hero' )); ?>
				</div>
			<?php } ?>

		</div>
		
	<?php
	}

}

/**
 * Recipe Featured Image Photo
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.6.0
 */

if ( ! function_exists( 'recipe_hero_output_single_photo' ) ) {

	function recipe_hero_output_single_photo() {

		// Variables
		global $post;

		$photo = get_the_post_thumbnail( $post->ID, 'rh-recipe-single', array( 'itemprop' => 'image' ) );
		$thumb = get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'recipe-schema-thumb', 'itemprop' => 'image' ) );

		if ( has_post_thumbnail() ) {
			echo '<div class="recipe-single-photo">';
			echo $photo;
			echo $thumb;
			echo '</div>';
		}

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

		// Variables
		global $post;

		$cuisine_terms = wp_get_object_terms($post->ID, 'cuisine');
			if(!empty($cuisine_terms)){
				if(!is_wp_error( $cuisine_terms )){
					$cuisine = '<ul>';
					foreach($cuisine_terms as $term){
						$cuisine .= '<li><a href="' . get_term_link($term->slug, 'cuisine') . '">' . $term->name . '</a></li>';
						$cuisine_meta = $term->name . ', ';
					}
					$cuisine .= '</ul>';
				}
			}

		$course_terms = wp_get_object_terms($post->ID, 'course');
			if(!empty($course_terms)){
				if(!is_wp_error( $course_terms )){
					$course = '<ul>';
					foreach($course_terms as $term){
						$course .= '<li><a href="' . get_term_link($term->slug, 'course') . '">' . $term->name . '</a></li>';
						$course_meta = $term->name . ', ';
					}
					$course .= '</ul>';
				}
			}

			?>

		<div class="recipe-single-tax">

			<?php if ( isset( $cuisine ) ) { ?>
				<div class="cuisine">
					<meta itemprop="recipeCuisine" content="<?php echo $cuisine_meta; ?>">
					<strong><?php _e( 'Cuisines', 'recipe-hero' ); ?>:</strong> <?php echo $cuisine; ?>
				</div>
			<?php } ?>

			<?php if ( isset ( $course ) ) { ?>
				<div class="course">
					<meta itemprop="recipeCategory" content="<?php echo $course_meta; ?>">	
					<strong><?php _e( 'Courses', 'recipe-hero' ); ?>:</strong> <?php echo $course; ?>
				</div>
			<?php } ?>

		</div>

	<?php
	}

}

/**
 * Recipe Details / Information
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_output_single_details' ) ) {

	function recipe_hero_output_single_details() {

		// Variables
		global $post;
		$serves 	= get_post_meta( $post->ID, '_recipe_hero_detail_serves', true );
		$equipment 	= get_post_meta ( $post->ID, '_recipe_hero_detail_equipment', false );
		$prep_time 	= recipe_hero_convert_minute_hour ( get_post_meta ( $post->ID, '_recipe_hero_detail_prep_time', true ) );
		$cook_time 	= recipe_hero_convert_minute_hour ( get_post_meta ( $post->ID, '_recipe_hero_detail_cook_time', true ) );
		$total_time = recipe_hero_convert_minute_hour ( recipe_hero_calc_total_cook_time() ); ?>

		<div class="recipe-single-details">

			<div class="rh-grid">

				<?php if ( $serves ) { ?>

				<div class="serves unit w-1-4">
					<strong>
						<?php if ( recipe_hero_get_option( 'rh-serves-text', 'recipe-hero-options' ) ) {
								echo recipe_hero_get_option( 'rh-serves-text', 'recipe-hero-options' );
							} else {
								_e( 'Serves', 'recipe-hero' );
							} ?>
					</strong> <span itemprop="recipeYield"><?php echo $serves; ?> <?php _e( 'People', 'recipe-hero' ); ?></span>
				</div>

				<?php } ?>

				<?php if ( $equipment ) { ?>
					<div class="equipment unit w-1-4">
						<strong>
							<?php if ( recipe_hero_get_option( 'rh-equipment-text', 'recipe-hero-options' ) ) {
									echo recipe_hero_get_option( 'rh-equipment-text', 'recipe-hero-options' );
								} else {
									_e( 'Equipment', 'recipe-hero' );
								} ?>
						</strong>
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
				<?php } ?>

				<?php if ( $prep_time ) { ?>
					<div class="prep-time unit w-1-4">
						<strong>
							<?php if ( recipe_hero_get_option( 'rh-prep-text', 'recipe-hero-options' ) ) {
									echo recipe_hero_get_option( 'rh-prep-text', 'recipe-hero-options' );
								} else {
									_e( 'Prep Time', 'recipe-hero' );
								} ?>
						</strong> <meta itemprop="prepTime" content="<?php echo recipe_hero_schema_prep_time(); ?>">
						<div class="the-time"><span class="dashicons dashicons-clock"></span> <?php echo $prep_time; ?></div>
					</div>
				<?php } ?>

				<?php if ( $cook_time ) { ?>

					<div class="cook-time unit w-1-4">
						<strong>
							<?php if ( recipe_hero_get_option( 'rh-cook-text', 'recipe-hero-options' ) ) {
									echo recipe_hero_get_option( 'rh-cook-text', 'recipe-hero-options' );
								} else {
									_e( 'Cook Time', 'recipe-hero' );
								} ?>
						</strong> <meta itemprop="cookTime" content="<?php echo recipe_hero_schema_cook_time(); ?>">
						<div class="the-time"><span class="dashicons dashicons-clock"></span> <?php echo $cook_time; ?></div>
						<meta itemprop="totalTime" content="<?php echo recipe_hero_schema_total_time(); ?>">
					</div>

				<?php } ?>

				<?php /* if ( $total_time ) { ?>

				<div class="total-time unit w-1-4">
					<strong>
					Total Time
					</strong>
					<meta itemprop="totalTime" content="<?php echo recipe_hero_schema_total_time(); ?>"> <?php echo $total_time; ?>
				</div>

				<?php } */ ?>

			</div>

			<hr class="recipe-single-seperator" />

		</div><!-- .recipe-single-details -->

	<?php
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

		// Variables
		$description = get_the_content();

		if ( $description ) { ?>

			<div class="recipe-single-content">

				<span itemprop="description">
					<?php echo $description; ?>
				</span>

				<hr class="recipe-single-seperator" />

			</div>

		<?php
		}

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

		// Variables
		global $post;
		$ingredients = get_post_meta( $post->ID, '_recipe_hero_ingredients_group', true );

		//if ( isset ( $ingredients[0]['_recipe_hero_ingredient_quantity'] ) ) {

			echo '<div class="recipe-single-ingredients">';

				echo '<h4 class="inredients-heading">' . __( 'Ingredients', 'recipe-hero' ) . '</h4>';

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

				    echo '<li class="ingredients-item" itemprop="ingredients">';
				    echo $ingredient_quantity . ' ';
				    echo $ingredient_amount . ' ';
				    echo $ingredient_name;
				    echo '</li>';

				}
				echo '</ul>';

			echo '<hr class="recipe-single-seperator" />';

			echo '</div><!-- .recipe-single-ingredients -->';

		//}

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

		// Variables
		global $post;
		$instructions = get_post_meta( $post->ID, '_recipe_hero_steps_group', true );

		if ( $instructions ) {

			echo '<div class="recipe-single-instructions">';

				echo '<h4 class="instructions-heading">' . __( 'Instructions', 'recipe-hero' ) . '</h4>';

				echo '<ol class="steps-list" itemprop="recipeInstructions">';
				$intruction_count = 1;
				foreach ( (array) $instructions as $key => $instruction ) {

				    $instruction_text = $instruction_image = '';

				    if ( isset( $instruction['_recipe_hero_step_instruction'] ) ) {
				        $instruction_text = $instruction['_recipe_hero_step_instruction'];
				    }

				    if ( isset ( $instruction['_recipe_hero_step_image'] ) ) {
				    	$instruction_image = '<a href="' . $instruction['_recipe_hero_step_image'] . '" class="steps-image-link" title="' . __( 'Step', 'recipe-hero' ) . ' ' . $intruction_count . '"><img src="' . $instruction['_recipe_hero_step_image'] . '" class="step-image" /></a>';
				  	} else {
				  		$instruction_image ='';
				  	}

				    echo '<li class="steps-item">';
				    echo wpautop( $instruction_text ) . ' ';
				    echo $instruction_image;
				    echo '</li>';

				    $intruction_count++;

				}
				echo '</ul>';

			echo '</div><!-- .recipe-single-ingredients -->';

		}

	}

}

/**
 * Recipe Nutrition Info
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_output_single_nutrition' ) ) {

	function recipe_hero_output_single_nutrition() {

		// Variables
		global $post;
		$nutrition 	= get_post_meta ( $post->ID, '_recipe_hero_detail_nutrition', true );

		if ( $nutrition ) { ?>

			<div class="recipe-single-nutrition" itemprop="nutrition" itemscope itemtype="http://schema.org/NutritionInformation">
				<strong><?php _e( 'Nutrition', 'recipe-hero' ); ?>:</strong> <?php echo $nutrition; ?>
			</div>

		<?php }

	}

}

/**
 * Recipe Comments
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_output_single_comments' ) ) {

	function recipe_hero_output_single_comments() {

		if ( comments_open() || get_comments_number() ) {
			//comments_template();
			comments_template( '/comments.php', true ); 
		}

	}

}

/******************************/


/**
 * Line Break
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
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
 * @since 	  0.5.0
 */

function recipe_hero_convert_minute_hour($time, $format = '%dh %02dm') {
    settype($time, 'integer');
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = $time % 60;
    return sprintf($format, $hours, $minutes);
}

/**
 * Function to calculate total prep/cook time
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

function recipe_hero_calc_total_cook_time() {

	// Variables
	global $post;
	$prep_time 	= (int) ( get_post_meta ( $post->ID, '_recipe_hero_detail_prep_time', true ) );
	$cook_time 	= (int) ( get_post_meta ( $post->ID, '_recipe_hero_detail_cook_time', true ) );

	$total_time = $prep_time + $cook_time;

	return $total_time;

}

/**
 * Small Function for Determing Ingredient Amount
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
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