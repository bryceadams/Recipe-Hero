<?php
/**
 * Contains the query functions for Recipe Hero which alter the front-end post queries and loops.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RH_Query' ) ) :

/**
 * RH_Query Class
 */
class RH_Query {

	/** @public array Query vars to add to wp */
	public $query_vars = array();

	/**
	 * Constructor for the query class. Hooks in methods.
	 *
	 * @access public
	 */
	public function __construct() {

		if ( ! is_admin() ) {

			add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
			add_action( 'wp', array( $this, 'remove_recipe_query' ) );

		}

	}

	/**
	 * Hook into pre_get_posts to do the main recipe query
	 *
	 * @access public
	 * @param mixed $q query object
	 * @return void
	 */
	public function pre_get_posts( $q ) {
		// We only want to affect the main query
		if ( ! $q->is_main_query() ) {
			return;
		}

		if ( get_option( 'recipe_hero_recipes_page_id' ) ) {

            $rh_home_id = get_option( 'recipe_hero_recipes_page_id' );

            if ( isset( $rh_home_id ) ) {
                $recipe_page = $rh_home_id;
            } else {
            	$recipe_page = '';
            }

        } else {
        	return;
        }

        if ( is_array( $q ) ) {
        	$current_id = array_key_exists( 'queried_object', $q ) && array_key_exists( 'ID', $q->queried_object ) ? $q->queried_object->ID : '';
		} else {
			$current_id = '';
		}     

		// Fix for verbose page rules
		if ( $current_id == $recipe_page ) {
			$q->set( 'post_type', 'recipe' );
			$q->set( 'page', '' );
			$q->set( 'pagename', '' );

			// Fix conditional Functions
			$q->is_archive           = true;
			$q->is_post_type_archive = true;
			$q->is_singular          = false;
			$q->is_page              = false;
		}

		// Fix for endpoints on the homepage
		if ( $q->is_home() && 'page' == get_option('show_on_front') && get_option('page_on_front') != $q->get('page_id') ) {
			$_query = wp_parse_args( $q->query );
			if ( ! empty( $_query ) && array_intersect( array_keys( $_query ), array_keys( $this->query_vars ) ) ) {
				$q->is_page     = true;
				$q->is_home     = false;
				$q->is_singular = true;

				$q->set( 'page_id', get_option('page_on_front') );
			}
		}

		// When orderby is set, WordPress shows posts. Get around that here.
		if ( $q->is_home() && 'page' == get_option('show_on_front') && get_option('page_on_front') == rh_get_page_id( 'recipes' ) ) {
			$_query = wp_parse_args( $q->query );
			if ( empty( $_query ) || ! array_diff( array_keys( $_query ), array( 'preview', 'page', 'paged', 'cpage', 'orderby' ) ) ) {
				$q->is_page = true;
				$q->is_home = false;
				$q->set( 'page_id', get_option('page_on_front') );
				$q->set( 'post_type', 'recipe' );
			}
		}

		// Special check for sites with the recipe archive on front
		if ( $q->is_page() && 'page' == get_option( 'show_on_front' ) && $q->get('page_id') == $recipe_page ) {

			// This is a front-page shop
			$q->set( 'post_type', 'recipe' );
			$q->set( 'page_id', '' );
			if ( isset( $q->query['paged'] ) ) {
				$q->set( 'paged', $q->query['paged'] );
			}

			// Define a variable so we know this is the front page shop later on
			define( 'RECIPE_IS_ON_FRONT', true );

			// Get the actual WP page to avoid errors and let us use is_front_page()
			// This is hacky but works. Awaiting http://core.trac.wordpress.org/ticket/21096
			global $wp_post_types;

			$recipe_page_object	= get_post( $recipe_page );

			$wp_post_types['recipe']->ID 			= $recipe_page_object->ID;
			$wp_post_types['recipe']->post_title 	= $recipe_page_object->post_title;
			$wp_post_types['recipe']->post_name 	= $recipe_page_object->post_name;
			$wp_post_types['recipe']->post_type    	= $recipe_page_object->post_type;
			$wp_post_types['recipe']->ancestors    	= get_ancestors( $recipe_page_object->ID, $recipe_page_object->post_type );

			// Fix conditional Functions like is_front_page
			$q->is_singular          = false;
			$q->is_post_type_archive = true;
			$q->is_archive           = true;
			$q->is_page              = true;

		// Only apply to recipe categories, the recipe post archive, the recipe page and recipe taxonomies
		} elseif ( ! $q->is_post_type_archive( 'recipe' ) && ! $q->is_tax( get_object_taxonomies( 'recipe' ) ) ) {
			return;
		}

		$this->recipe_query( $q );

		// We're on a recipe archive page so queue the get_recipes_in_view method
		add_action( 'wp', array( $this, 'get_recipes_in_view' ), 2);

		// And remove the pre_get_posts hook
		$this->remove_recipe_query();
	}


	/**
	 * Query the recipes, applying sorting/ordering etc. This applies to the main wordpress loop
	 *
	 * @access public
	 * @param mixed $q
	 * @return void
	 */
	public function recipe_query( $q ) {

		// Meta query
		$meta_query = $this->get_meta_query( $q->get( 'meta_query' ) );

		// Ordering
		$ordering   = $this->get_catalog_ordering_args();

		// Get a list of post id's which match the current filters set (in the layered nav and price filter)
		$post__in   = array_unique( apply_filters( 'loop_shop_post_in', array() ) );

		// Ordering query vars
		$q->set( 'orderby', $ordering['orderby'] );
		$q->set( 'order', $ordering['order'] );
		if ( isset( $ordering['meta_key'] ) ) {
			$q->set( 'meta_key', $ordering['meta_key'] );
		}

		// Query vars that affect posts shown
		$q->set( 'meta_query', $meta_query );
		$q->set( 'post__in', $post__in );
		$q->set( 'posts_per_page', $q->get( 'posts_per_page' ) ? $q->get( 'posts_per_page' ) : apply_filters( 'loop_recipe_per_page', get_option( 'posts_per_page' ) ) );

		// Set a special variable
		$q->set( 'rh_query', true );

		// Store variables
		$this->post__in   = $post__in;
		$this->meta_query = $meta_query;

		do_action( 'recipe_hero_recipe_query', $q, $this );
	}

	/**
	 * Returns an array of arguments for ordering recipes based on the selected values
	 *
	 * @access public
	 * @return array
	 */
	public function get_catalog_ordering_args( $orderby = '', $order = '' ) {
		global $wpdb;

		// Get ordering from query string unless defined
		if ( ! $orderby ) {
			$orderby_value = isset( $_GET['orderby'] ) ? rh_clean( $_GET['orderby'] ) : apply_filters( 'recipe_hero_recipe_order', get_option( 'recipe_hero_recipe_order' ) );

			// Get order + orderby args from string
			$orderby_value = explode( '-', $orderby_value );
			$orderby       = esc_attr( $orderby_value[0] );
			$order         = ! empty( $orderby_value[1] ) ? $orderby_value[1] : $order;
		}

		$orderby = strtolower( $orderby );
		$order   = strtoupper( $order );
		$args    = array();

		// default - menu_order
		$args['orderby']  = 'menu_order title';
		$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
		$args['meta_key'] = '';

		switch ( $orderby ) {
			case 'rand' :
				$args['orderby']  = 'rand';
			break;
			case 'date' :
				$args['orderby']  = 'date';
				$args['order']    = $order == 'ASC' ? 'ASC' : 'DESC';
			break;
			case 'title' :
				$args['orderby']  = 'title';
				$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
			break;
		}

		return apply_filters( 'recipe_hero_get_recipe_ordering_args', $args );
	}

	/**
	 * Appends meta queries to an array.
	 * @access public
	 * @param array $meta_query
	 * @return array
	 */
	public function get_meta_query( $meta_query = array() ) {
		if ( ! is_array( $meta_query ) ) {
			$meta_query = array();
		}

		return array_filter( $meta_query );
	}

	/**
	 * Get an unpaginated list all recipe ID's (both filtered and unfiltered). Makes use of transients.
	 *
	 * @access public
	 * @return void
	 */
	public function get_recipes_in_view() {
		global $wp_the_query;

		$unfiltered_recipe_ids = array();

		// Get main query
		$current_wp_query = $wp_the_query->query;

		// Get WP Query for current page (without 'paged')
		unset( $current_wp_query['paged'] );

		// Generate a transient name based on current query
		$transient_name = 'rh_uf_pid_' . md5( http_build_query( $current_wp_query ) . RH_Cache_Helper::get_transient_version( 'recipe_query' ) );
		$transient_name = ( is_search() ) ? $transient_name . '_s' : $transient_name;

		if ( false === ( $unfiltered_recipe_ids = get_transient( $transient_name ) ) ) {

		    // Get all visible posts, regardless of filters
		    $unfiltered_recipe_ids = get_posts(
				array_merge(
					$current_wp_query,
					array(
						'post_type'              => 'recipe',
						'numberposts'            => -1,
						'post_status'            => 'publish',
						'meta_query'             => $this->meta_query,
						'fields'                 => 'ids',
						'no_found_rows'          => true,
						'update_post_meta_cache' => false,
						'update_post_term_cache' => false,
						'pagename'               => ''
					)
				)
			);

			set_transient( $transient_name, $unfiltered_recipe_ids, YEAR_IN_SECONDS );
		}

		// Store the variable
		$this->unfiltered_recipe_ids = $unfiltered_recipe_ids;

		// Also store filtered posts ids...
		if ( sizeof( $this->post__in ) > 0 ) {
			$this->filtered_recipe_ids = array_intersect( $this->unfiltered_recipe_ids, $this->post__in );
		} else {
			$this->filtered_recipe_ids = $this->unfiltered_recipe_ids;
		}
	}

	/**
	 * Remove the query
	 *
	 * @access public
	 * @return void
	 */
	public function remove_recipe_query() {
		remove_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
	}

}

endif;

return new RH_Query();