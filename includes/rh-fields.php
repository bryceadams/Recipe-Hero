<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Include CMB2
if ( file_exists( __DIR__ . '/fields/init.php' ) ) {
	require_once  __DIR__ . '/fields/init.php';
}
// Include CMB2 - Select2 Custom Field
if ( file_exists( __DIR__ . '/fields/custom/cmb2-select2/cmb2-select2.php' ) ) {
	require_once __DIR__ . '/fields/custom/cmb2-select2/cmb2-select2.php';
}

// @todo rename the filter this filters
add_filter( 'cmb2_meta_boxes', 'recipe_hero_cmb2_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @param  	  array $meta_boxes
 * @return 	  array
 *
 * @package Recipe Hero
 * @author  Captain Theme <info@captaintheme.com>
 * @since   1.0.0
 */
function recipe_hero_cmb2_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_recipe_hero_';


	/**
	 * Recipe Details
	 */
	$meta_boxes['recipe_details'] = array(
		'id'         => 'details_container',
		'title'      => __( 'Recipe Details', 'recipe-hero' ),
		'object_types'      => array( 'recipe', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb2_styles' => true, // Enqueue the CMB2 stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Servings', 'recipe-hero' ),
				'desc' => __( 'A number for the servings amount', 'recipe-hero' ),
				'id'   => $prefix . 'detail_serves',
				'type' => 'text_small',
				'attributes' => array(
									'placeholder' => 'eg. 4',
				),
			),
			array(
				'name' => __( 'Servings Type', 'recipe-hero' ),
				'desc' => __( 'The type of servings that relates to the Servings Amount, like how many people it will feed or how many burgers it can make, etc.', 'recipe-hero' ),
				'id'   => $prefix . 'detail_serves_type',
				'type' => 'text_small',
				'attributes' => array(
									'placeholder' => 'eg. People',
				),
			),
			array(
				'name' => __( 'Preparation Time', 'recipe-hero' ),
				'id'   => $prefix . 'detail_prep_time',
				'type' => 'text_small',
				'before' => ' ',
				'after' => 'Minutes',
				'attributes' => array(
									'placeholder' => 'eg. 15',
				),
			),
			array(
				'name' => __( 'Cooking Time', 'recipe-hero' ),
				'id'   => $prefix . 'detail_cook_time',
				'type' => 'text_small',
				'before' => ' ',
				'after' => 'Minutes',
				'attributes' => array(
									'placeholder' => 'eg. 85',
				),
			),
			array(
				'name' => __( 'Equipment Needed', 'recipe-hero' ),
				'desc' => __( 'Any special equipment worthy of mentioning that is required.', 'recipe-hero' ),
				'id'   => $prefix . 'detail_equipment',
				'type' => 'text_medium',
				'repeatable' => true,
				'attributes' => array(
									'placeholder' => 'eg. Thermomix, Slow-Cooker',
				),
			),
			array(
				'name' => __( 'Nutritional Info', 'recipe-hero' ),
				'desc' => __( 'A summary of nutrition information you would like to include.', 'recipe-hero' ),
				'id'   => $prefix . 'detail_nutrition',
				'type' => 'textarea_small',
				'attributes' => array(
									'placeholder' => 'eg. Per serving: Calories (kcal) 657.7',
				),
			),
		),
	);


	/**
	 * Ingredients
	 */
	$meta_boxes['recipe_ingredients'] = array(
		'id'         => 'ingredients_container',
		'title'      => __( 'Ingredients', 'recipe-hero' ),
		'object_types'      => array( 'recipe', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'ingredients_group',
				'type'        => 'group',
				'description' => __( 'Add all of the ingredients for this recipe.', 'recipe-hero' ),
				'options'     => array(
					'group_title'   => __( 'Ingredient {#}', 'recipe-hero' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Ingredient', 'recipe-hero' ),
					'remove_button' => __( 'Remove Ingredient', 'recipe-hero' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => apply_filters( 'recipe_hero_meta_ingredients_fields', array(
					array(
						'name' => __( 'Quantity', 'recipe-hero' ),
						//'desc' => __( 'Please enter in integer form, so 1/2 a teaspoon would just be 0.5.', 'recipe-hero' ),
						'id'   => 'quantity',
						'type' => 'text_small',
						// 'repeatable' => true,
						// Should it be a text input and a select input for 1/2, 1/3 etc.? How do we take fractions - fraction or decimal?
					),
					array(
						'name'    => __( 'Amount', 'recipe-hero' ),
						//'desc'    => __( 'field description (optional)', 'recipe-hero' ),
						'id'      => 'amount',
						'type'    => 'select', // will use 'pw_select' when issue is fixed - https://github.com/mustardBees/cmb-field-select2/issues/10
						'options' => apply_filters( 'recipe_hero_meta_ingredients_amount', array(
							'gm' 	 => __( 'Gram (gm)', 'recipe-hero' ),
							'oz'   	 => __( 'Ounce (oz)', 'recipe-hero' ),
							'ml'     => __( 'Milliliter (ml)', 'recipe-hero' ),
							'ts'	 => __( 'Teaspoon', 'recipe-hero' ),
							'tas'	 => __( 'Tablespoon', 'recipe-hero' ),
							'cup'	 => __( 'Cup', 'recipe-hero' ),
							'lt'     => __( 'Liter (L)', 'recipe-hero' ),
							'lb'     => __( 'Pound (lb)', 'recipe-hero' ),
							'kg'     => __( 'Kilogram (kg)', 'recipe-hero' ),
							'slice'	 => __( 'Slices', 'recipe-hero' ),
							'piece'	 => __( 'Pieces', 'recipe-hero' ),
							'none'	 => __( 'None (blank)', 'recipe-hero' ),
							// Should there be slices / cloves / etc. as terms of measurement? Get feedback.
							// Also, what about sizes? Small / Large etc. - we don't want this to be a long list of all possible amounts but we want to make it as easy as possible for users.
						) ),
						'default'	=> apply_filters( 'recipe_hero_meta_ingredients_amount_default', 'gm' ),
    					//'sanitization_cb' => 'pw_select2_sanitise',
					),
					array(
						'name' => __( 'Ingredient', 'recipe-hero' ),
						//'desc' => __( 'field description (optional)', 'recipe-hero' ),
						'id'   => 'name',
						'type' => 'text_medium',
						// 'repeatable' => true,
						'attributes' => array(
							'class' => 'ingredient_name_field',
							'placeholder' => __( 'Start typing to see used ingredients (or add a new one)', 'recipe-hero' ),
						),
					),
				) ),
			),
		),
	);

	
	/**
	 * Steps
	 */
	$meta_boxes['recipe_steps'] = array(
		'id'         => 'steps_container',
		'title'      => __( 'Steps', 'recipe-hero' ),
		'object_types'      => array( 'recipe', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'steps_group',
				'type'        => 'group',
				'description' => __( 'Add all of the preparation and cooking steps for this recipe.', 'recipe-hero' ),
				'options'     => array(
					'group_title'   => __( 'Step {#}', 'recipe-hero' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Step', 'recipe-hero' ),
					'remove_button' => __( 'Remove Step', 'recipe-hero' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => apply_filters( 'recipe_hero_meta_steps_fields', array(
					array(
						'name' => __( 'Instructions', 'recipe-hero' ),
						'id'   => $prefix . 'step_instruction',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Step Photo', 'recipe-hero' ),
						'desc' => __( 'Upload an image using the media uploader (optional)', 'recipe-hero' ),
						'id'   => $prefix . 'step_image',
						'type' => 'file',
						'allow' => array( 'attachment' ), // only attachments allowed --> no URLs
					),
					// Add time per step?
				), $prefix ),
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}