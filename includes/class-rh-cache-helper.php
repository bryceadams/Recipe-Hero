<?php
/**
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * RH_Cache_Helper class.
 *
 * @class 		RH_Cache_Helper
 * @version		1.0.0
 * @package		Recipe Hero/Classes
 * @category	Class
 * @author 		Recipe Hero
 */
class RH_Cache_Helper {

	/**
	 * Hook in methods
	 */
	public static function init() {
		add_action( 'before_recipe_hero_init', array( __CLASS__, 'prevent_caching' ) );
	}

	/**
	 * Get transient version
	 *
	 * When using transients with unpredictable names, e.g. those containing an md5
	 * hash in the name, we need a way to invalidate them all at once.
	 *
	 * When using default WP transients we're able to do this with a DB query to
	 * delete transients manually.
	 *
	 * With external cache however, this isn't possible. Instead, this function is used
	 * to append a unique string (based on time()) to each transient. When transients
	 * are invalidated, the transient version will increment and data will be regenerated.
	 *
	 * Raised in issue https://github.com/woothemes/woocommerce/issues/5777
	 * Adapted from ideas in http://tollmanz.com/invalidation-schemes/
	 *
	 * @param  string  $group   Name for the group of transients we need to invalidate
	 * @param  boolean $refresh true to force a new version
	 * @return string transient version based on time(), 10 digits
	 */
	public static function get_transient_version( $group, $refresh = false ) {
		$transient_name  = $group . '-transient-version';
		$transient_value = get_transient( $transient_name );

		if ( false === $transient_value || true === $refresh ) {
			$transient_value = time();
			set_transient( $transient_name, $transient_value );
		}
		return $transient_value;
	}

	/**
	 * Get the page name/id for a WC page
	 * @param  string $wc_page
	 * @return array
	 */
	private static function get_page_uris( $rh_page ) {
		$rh_page_uris = array();

		if ( ( $page_id = rh_get_page_id( $rh_page ) ) && $page_id > 0 && ( $page = get_post( $page_id ) ) ) {
			$rh_page_uris[] = 'p=' . $page_id;
			$rh_page_uris[] = '/' . $page->post_name;
		}

		return $rh_page_uris;
	}


	/**
	 * Prevent caching on dynamic pages.
	 *
	 * @access public
	 * @return void
	 */
	public static function prevent_caching() {
		if ( false === ( $rh_page_uris = get_transient( 'recipe_hero_cache_excluded_uris' ) ) ) {
			$rh_page_uris   = array_filter( array_merge( self::get_page_uris( 'recipes' ) ) );
	    	set_transient( 'recipe_hero_cache_excluded_uris', $rh_page_uris );
		}

		if ( is_array( $rh_page_uris ) ) {
			foreach( $rh_page_uris as $uri ) {
				if ( strstr( $_SERVER['REQUEST_URI'], $uri ) ) {
					self::nocache();
					break;
				}
			}
		}
	}

	/**
	 * Set nocache constants and headers.
	 *
	 * @access private
	 * @return void
	 */
	private static function nocache() {
		if ( ! defined( 'DONOTCACHEPAGE' ) ) {
			define( "DONOTCACHEPAGE", "true" );
		}

		if ( ! defined( 'DONOTCACHEOBJECT' ) ) {
			define( "DONOTCACHEOBJECT", "true" );
		}

		if ( ! defined( 'DONOTCACHEDB' ) ) {
			define( "DONOTCACHEDB", "true" );
		}

		nocache_headers();
	}

}

RH_Cache_Helper::init();