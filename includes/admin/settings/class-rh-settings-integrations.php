<?php
/**
 * Recipe Hero Integration Settings
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since     1.0.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RH_Settings_Integrations' ) ) :

/**
 * RH_Settings_Integrations
 */
class RH_Settings_Integrations extends RH_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id    = 'integration';
		$this->label = __( 'Integration', 'recipe-hero' );

		if ( isset( RH()->integrations ) && RH()->integrations->get_integrations() ) {
			add_filter( 'recipe_hero_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
			add_action( 'recipe_hero_sections_' . $this->id, array( $this, 'output_sections' ) );
			add_action( 'recipe_hero_settings_' . $this->id, array( $this, 'output' ) );
			add_action( 'recipe_hero_settings_save_' . $this->id, array( $this, 'save' ) );
		}
	}

	/**
	 * Get sections
	 *
	 * @return array
	 */
	public function get_sections() {
		global $current_section;

		$sections = array();

		$integrations = RH()->integrations->get_integrations();

		if ( ! $current_section && ! empty( $integrations ) ) {
			$current_section = current( $integrations )->id;
		}

		if ( sizeof( $integrations ) > 1 ) {
			foreach ( $integrations as $integration ) {
				$title = empty( $integration->method_title ) ? ucfirst( $integration->id ) : $integration->method_title;

				$sections[ strtolower( $integration->id ) ] = esc_html( $title );
			}
		}

		return apply_filters( 'recipe_hero_get_sections_' . $this->id, $sections );
	}

	/**
	 * Output the settings
	 */
	public function output() {
		global $current_section;

		$integrations = RH()->integrations->get_integrations();

		if ( isset( $integrations[ $current_section ] ) ) {
			$integrations[ $current_section ]->admin_options();
		}
	}
}

endif;

return new RH_Settings_Integrations();