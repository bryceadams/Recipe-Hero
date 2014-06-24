<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */



add_filter( 'cmb_meta_boxes', 'recipe_hero_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @param  	  array $meta_boxes
 * @return 	  array
 */
function recipe_hero_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_recipe_hero_';


	/**
	 * Recipe Details
	 */
	$meta_boxes['recipe_details'] = array(
		'id'         => 'details_container',
		'title'      => __( 'Recipe Details', 'cmb' ),
		'pages'      => array( 'recipe', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Serves', 'cmb' ),
				//'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'detail_serves',
				'type' => 'text_small',
				'after' => 'People',
				'attributes' => array(
									'placeholder' => 'eg. 4',
				),
			),
			array(
				'name' => __( 'Preparation Time', 'cmb' ),
				'id'   => $prefix . 'detail_prep_time',
				'type' => 'text_small',
				'before' => ' ',
				'after' => 'Minutes',
				'attributes' => array(
									'placeholder' => 'eg. 15',
				),
			),
			array(
				'name' => __( 'Cooking Time', 'cmb' ),
				'id'   => $prefix . 'detail_cook_time',
				'type' => 'text_small',
				'before' => ' ',
				'after' => 'Minutes',
				'attributes' => array(
									'placeholder' => 'eg. 85',
				),
			),
			array(
				'name' => __( 'Equipment Needed', 'cmb' ),
				'desc' => __( 'Any special equipment worthy of mentioning that is required.', 'cmb' ),
				'id'   => $prefix . 'detail_equipment',
				'type' => 'text_medium',
				'repeatable' => true,
				'attributes' => array(
									'placeholder' => 'eg. Thermomix, Slow-Cooker',
				),
			),
			array(
				'name' => __( 'Nutritional Info', 'cmb' ),
				'desc' => __( 'A summary of nutrition information you would like to include.', 'cmb' ),
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
		'title'      => __( 'Ingredients', 'cmb' ),
		'pages'      => array( 'recipe', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'ingredients_group',
				'type'        => 'group',
				'description' => __( 'Add all of the ingredients for this recipe.', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Ingredient {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Ingredient', 'cmb' ),
					'remove_button' => __( 'Remove Ingredient', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => __( 'Quantity', 'cmb' ),
						//'desc' => __( 'Please enter in integer form, so 1/2 a teaspoon would just be 0.5.', 'cmb' ),
						'id'   => 'quantity',
						'type' => 'text_small',
						// 'repeatable' => true,
						// Should it be a text input and a select input for 1/2, 1/3 etc.? How do we take fractions - fraction or decimal?
					),
					array(
						'name'    => __( 'Amount', 'cmb' ),
						//'desc'    => __( 'field description (optional)', 'cmb' ),
						'id'      => 'amount',
						'type'    => 'select',
						'options' => array(
							'gm' 	 => __( 'Gram (gm)', 'cmb' ),
							'oz'   	 => __( 'Ounce (oz)', 'cmb' ),
							'ml'     => __( 'Milliliter (ml)', 'cmb' ),
							'ts'	 => __( 'Teaspoon', 'cmb' ),
							'tas'	 => __( 'Tablespoon', 'cmb' ),
							'cup'	 => __( 'Cup', 'cmb' ),
							'lt'     => __( 'Liter (L)', 'cmb' ),
							'lb'     => __( 'Pound (lb)', 'cmb' ),
							'kg'     => __( 'Kilogram (kg)', 'cmb' ),
							'slice'	 => __( 'Slices', 'cmb' ),
							'piece'	 => __( 'Pieces', 'cmb' ),
							'none'	 => __( 'None (blank)', 'cmb' ),
							// Should there be slices / cloves / etc. as terms of measurement? Get feedback.
							// Also, what about sizes? Small / Large etc. - we don't want this to be a long list of all possible amounts but we want to make it as easy as possible for users.
						),
					),
					array(
						'name' => __( 'Ingredient', 'cmb' ),
						//'desc' => __( 'field description (optional)', 'cmb' ),
						'id'   => 'name',
						'type' => 'text_medium',
						// 'repeatable' => true,
					),
				),
			),
		),
	);

	
	/**
	 * Steps
	 */
	$meta_boxes['recipe_steps'] = array(
		'id'         => 'steps_container',
		'title'      => __( 'Steps', 'cmb' ),
		'pages'      => array( 'recipe', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'steps_group',
				'type'        => 'group',
				'description' => __( 'Add all of the preparation and cooking steps for this recipe.', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Step {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Step', 'cmb' ),
					'remove_button' => __( 'Remove Step', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => __( 'Instructions', 'cmb' ),
						//'desc' => __( 'field description (optional)', 'cmb' ),
						'id'   => $prefix . 'step_instruction',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Step Photo', 'cmb' ),
						'desc' => __( 'Upload an image or enter a URL (optional)', 'cmb' ),
						'id'   => $prefix . 'step_image',
						'type' => 'file',
						'allow' => array( 'attachment' ), // onlu attachments allowed --> no URLs
					),
					// Add time per step?
				),
			),
		),
	);


	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['test_metabox'] = array(
		'id'         => 'test_metabox',
		'title'      => __( 'Test Metabox', 'cmb' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'       => __( 'Test Text', 'cmb' ),
				'desc'       => __( 'field description (optional)', 'cmb' ),
				'id'         => $prefix . 'test_text',
				'type'       => 'text',
				'show_on_cb' => 'cmb_test_text_show_on_cb', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),
			array(
				'name' => __( 'Test Text Small', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textsmall',
				'type' => 'text_small',
				'repeatable' => true,
			),
			array(
				'name' => __( 'Test Text Medium', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textmedium',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Website URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'url',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Test Text Email', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'email',
				'type' => 'text_email',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Test Time', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_time',
				'type' => 'text_time',
			),
			array(
				'name' => __( 'Time zone', 'cmb' ),
				'desc' => __( 'Time zone', 'cmb' ),
				'id'   => $prefix . 'timezone',
				'type' => 'select_timezone',
			),
			array(
				'name' => __( 'Test Date Picker', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textdate',
				'type' => 'text_date',
			),
			array(
				'name' => __( 'Test Date Picker (UNIX timestamp)', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textdate_timestamp',
				'type' => 'text_date_timestamp',
				// 'timezone_meta_key' => $prefix . 'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
			),
			array(
				'name' => __( 'Test Date/Time Picker Combo (UNIX timestamp)', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_datetime_timestamp',
				'type' => 'text_datetime_timestamp',
			),
			// This text_datetime_timestamp_timezone field type
			// is only compatible with PHP versions 5.3 or above.
			// Feel free to uncomment and use if your server meets the requirement
			// array(
			// 	'name' => __( 'Test Date/Time Picker/Time zone Combo (serialized DateTime object)', 'cmb' ),
			// 	'desc' => __( 'field description (optional)', 'cmb' ),
			// 	'id'   => $prefix . 'test_datetime_timestamp_timezone',
			// 	'type' => 'text_datetime_timestamp_timezone',
			// ),
			array(
				'name' => __( 'Test Money', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textmoney',
				'type' => 'text_money',
				// 'before'     => '£', // override '$' symbol if needed
				// 'repeatable' => true,
			),
			array(
				'name'    => __( 'Test Color Picker', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'test_colorpicker',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			array(
				'name' => __( 'Test Text Area', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textarea',
				'type' => 'textarea',
			),
			array(
				'name' => __( 'Test Text Area Small', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textareasmall',
				'type' => 'textarea_small',
			),
			array(
				'name' => __( 'Test Text Area for Code', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_textarea_code',
				'type' => 'textarea_code',
			),
			array(
				'name' => __( 'Test Title Weeeee', 'cmb' ),
				'desc' => __( 'This is a title description', 'cmb' ),
				'id'   => $prefix . 'test_title',
				'type' => 'title',
			),
			array(
				'name'    => __( 'Test Select', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'test_select',
				'type'    => 'select',
				'options' => array(
					'standard' => __( 'Option One', 'cmb' ),
					'custom'   => __( 'Option Two', 'cmb' ),
					'none'     => __( 'Option Three', 'cmb' ),
				),
			),
			array(
				'name'    => __( 'Test Radio inline', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'test_radio_inline',
				'type'    => 'radio_inline',
				'options' => array(
					'standard' => __( 'Option One', 'cmb' ),
					'custom'   => __( 'Option Two', 'cmb' ),
					'none'     => __( 'Option Three', 'cmb' ),
				),
			),
			array(
				'name'    => __( 'Test Radio', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'test_radio',
				'type'    => 'radio',
				'options' => array(
					'option1' => __( 'Option One', 'cmb' ),
					'option2' => __( 'Option Two', 'cmb' ),
					'option3' => __( 'Option Three', 'cmb' ),
				),
			),
			array(
				'name'     => __( 'Test Taxonomy Radio', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'text_taxonomy_radio',
				'type'     => 'taxonomy_radio',
				'taxonomy' => 'category', // Taxonomy Slug
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name'     => __( 'Test Taxonomy Select', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'text_taxonomy_select',
				'type'     => 'taxonomy_select',
				'taxonomy' => 'category', // Taxonomy Slug
			),
			array(
				'name'     => __( 'Test Taxonomy Multi Checkbox', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'test_multitaxonomy',
				'type'     => 'taxonomy_multicheck',
				'taxonomy' => 'post_tag', // Taxonomy Slug
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name' => __( 'Test Checkbox', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'test_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name'    => __( 'Test Multi Checkbox', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'test_multicheckbox',
				'type'    => 'multicheck',
				'options' => array(
					'check1' => __( 'Check One', 'cmb' ),
					'check2' => __( 'Check Two', 'cmb' ),
					'check3' => __( 'Check Three', 'cmb' ),
				),
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name'    => __( 'Test wysiwyg', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'test_wysiwyg',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 5, ),
			),
			array(
				'name' => __( 'Test Image', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL.', 'cmb' ),
				'id'   => $prefix . 'test_image',
				'type' => 'file',
			),
			array(
				'name'         => __( 'Multiple Files', 'cmb' ),
				'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb' ),
				'id'           => $prefix . 'test_file_list',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			array(
				'name' => __( 'oEmbed', 'cmb' ),
				'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'cmb' ),
				'id'   => $prefix . 'test_embed',
				'type' => 'oembed',
			),
		),
	);

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$meta_boxes['about_page_metabox'] = array(
		'id'         => 'about_page_metabox',
		'title'      => __( 'About Page Metabox', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'     => array(
			array(
				'name' => __( 'Test Text', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . '_about_test_text',
				'type' => 'text',
			),
		)
	);

	/**
	 * Repeatable Field Groups
	 */
	$meta_boxes['field_group'] = array(
		'id'         => 'field_group',
		'title'      => __( 'Repeating Field Group', 'cmb' ),
		'pages'      => array( 'page', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'repeat_group',
				'type'        => 'group',
				'description' => __( 'Generates reusable form entries', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Entry {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Entry', 'cmb' ),
					'remove_button' => __( 'Remove Entry', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Entry Title',
						'id'   => 'title',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					array(
						'name' => 'Description',
						'description' => 'Write a short description for this entry',
						'id'   => 'description',
						'type' => 'textarea_small',
					),
					array(
						'name' => 'Entry Image',
						'id'   => 'image',
						'type' => 'file',
					),
					array(
						'name' => 'Image Caption',
						'id'   => 'image_caption',
						'type' => 'text',
					),
				),
			),
		),
	);

	/**
	 * Metabox for the user profile screen
	 */
	$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'User Profile Metabox', 'cmb' ),
		'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names' => true,
		'cmb_styles' => false, // Show cmb bundled styles.. not needed on user profile page
		'fields'     => array(
			array(
				'name'     => __( 'Extra Info', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'exta_info',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name'    => __( 'Avatar', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			),
			array(
				'name' => __( 'Facebook URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'User Field', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'user_text_field',
				'type' => 'text',
			),
		)
	);

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb_metabox_form` helper function. See wiki for more info.
	 */
	$meta_boxes['options_page'] = array(
		'id'      => 'options_page',
		'title'   => __( 'Theme Options Metabox', 'cmb' ),
		'show_on' => array( 'key' => 'options-page', 'value' => array( $prefix . 'theme_options', ), ),
		'fields'  => array(
			array(
				'name'    => __( 'Site Background Color', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'recipe_hero_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function recipe_hero_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'fields/init.php';

}
