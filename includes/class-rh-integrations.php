<?php
/**
 * Recipe Hero Integrations class
 *
 * Loads Integrations into Recipe Hero.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since     1.0.5
 */
class RH_Integrations {

	/** @var array Array of integration classes */
	public $integrations = array();

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {

		do_action( 'recipe_hero_integrations_init' );

		$load_integrations = apply_filters( 'recipe_hero_integrations', array() );

		// Load integration classes
		foreach ( $load_integrations as $integration ) {

			$load_integration = new $integration();

			$this->integrations[ $load_integration->id ] = $load_integration;

		}
		

	}

	/**
	 * Return loaded integrations.
	 *
	 * @access public
	 * @return array
	 */
	public function get_integrations() {

		return $this->integrations;

	}

}