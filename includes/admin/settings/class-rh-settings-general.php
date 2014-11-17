<?php
/**
 * Recipe Hero General Settings
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RH_Settings_General' ) ) :

/**
 * RH_Settings_General
 */
class RH_Settings_General extends RH_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id    = 'general';
		$this->label = __( 'General', 'recipe-hero' );

		add_filter( 'recipe_hero_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
		add_action( 'recipe_hero_settings_' . $this->id, array( $this, 'output' ) );
		add_action( 'recipe_hero_settings_save_' . $this->id, array( $this, 'save' ) );
	}

	/**
	 * Get settings array
	 *
	 * @return array
	 */
	public function get_settings() {

		$settings = apply_filters( 'recipe_hero_general_settings', array(

			array( 'title' => __( 'General Options', 'recipe-hero' ), 'type' => 'title', 'desc' => '', 'id' => 'general_options' ),

			array(
				'title'    => __( 'Recipe Page', 'recipe-hero' ),
				'desc'     => __( 'The page you select here will be the home of all your recipes. Additionally, the \'Recipe Archive\' of your site can be found at: ', 'recipe-hero' ) . site_url() . '/recipes/',
				'id'       => 'recipe_hero_page',
				'type'     => 'single_select_page',
				'default'  => '',
				'class'    => 'select2_select_std',
				'css'      => 'min-width:300px;',
				'desc_tip' => true,
			),

			array( 'type' => 'sectionend', 'id' => '' ),

			array(
				'title' => __( 'Recipe Images', 'recipe-hero' ),
				'type' 	=> 'title',
				'desc' 	=> sprintf( __( 'These settings affect the display and dimensions of images in your recipes - the display on the front-end will still be affected by CSS styles. After changing these settings you will need to <a href="%s">regenerate your thumbnails</a>.', 'recipe-hero' ), 'http://wordpress.org/extend/plugins/regenerate-thumbnails/' ),
				'id' 	=> 'image_options'
			),

			array(
				'title'    => __( 'Main Recipe Image', 'recipe-hero' ),
				'desc'     => __( 'This size is for the main image in archives and single recipe pages', 'recipe-hero' ),
				'id'       => 'recipe_single_image_size',
				'css'      => '',
				'type'     => 'image_width',
				'default'  => array(
					'width'  => '700',
					'height' => '9999',
					'crop'   => 1
				),
				'desc_tip' =>  true,
			),

			array(
				'title'    => __( 'Recipe Steps Images', 'recipe-hero' ),
				'desc'     => __( 'This is the size of the images attached to steps / instructions on a single recipe page', 'recipe-hero' ),
				'id'       => 'recipe_steps_image_size',
				'css'      => '',
				'type'     => 'image_width',
				'default'  => array(
					'width'  => '650',
					'height' => '9999',
					'crop'   => 1
				),
				'desc_tip' =>  true,
			),

			array(
				'title'    => __( 'Recipe Thumbnails', 'recipe-hero' ),
				'desc'     => __( 'This size is usually used for the gallery of images on a single recipe page', 'recipe-hero' ),
				'id'       => 'recipe_thumbnail_image_size',
				'css'      => '',
				'type'     => 'image_width',
				'default'  => array(
					'width'  => '90',
					'height' => '90',
					'crop'   => 1
				),
				'desc_tip' =>  true,
			),

			array(
				'title'         => __( 'Product Image Gallery', 'recipe-hero' ),
				'desc'          => __( 'Enable Lightbox for product images', 'recipe-hero' ),
				'id'            => 'woocommerce_enable_lightbox',
				'default'       => 'yes',
				'desc_tip'      => __( 'Include WooCommerce\'s lightbox. Product gallery images will open in a lightbox.', 'recipe-hero' ),
				'type'          => 'checkbox'
			),

			array(
				'type' 	=> 'sectionend',
				'id' 	=> 'image_options'
			),

		) );

		return apply_filters( 'recipe_hero_get_settings_' . $this->id, $settings );
	}


	/**
	 * Save settings
	 */
	public function save() {
		$settings = $this->get_settings();

		RH_Admin_Settings::save_fields( $settings );
	}

}

endif;

return new RH_Settings_General();