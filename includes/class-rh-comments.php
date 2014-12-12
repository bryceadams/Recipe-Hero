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
 * Comments
 *
 * Handle comments (ratings too)
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */
class RH_Comments {

	/**
	 * Hook in methods
	 */
	public static function init() {
		// Rating recipes
		add_action( 'comment_post', array( __CLASS__, 'add_comment_rating' ), 1 );

		// clear transients
		add_action( 'wp_update_comment_count', array( __CLASS__, 'clear_transients' ) );

	}

	/**
	 * Rating field for comments.
	 *
	 * @param mixed $comment_id
	 */
	public static function add_comment_rating( $comment_id ) {
		if ( isset( $_POST['rating'] ) ) {
			if ( ! $_POST['rating'] || $_POST['rating'] > 5 || $_POST['rating'] < 0 ) {
				return;
			}

			add_comment_meta( $comment_id, 'rating', (int) esc_attr( $_POST['rating'] ), true );
		}
	}

	/**
	 * Clear transients for a review.
	 *
	 * @param mixed $post_id
	 */
	public static function clear_transients( $post_id ) {
		$post_id = absint( $post_id );
		delete_transient( 'rh_average_rating_' . $post_id );
		delete_transient( 'rh_rating_count_' . $post_id );
		delete_transient( 'rh_rating_count_' . $post_id . '_1' );
		delete_transient( 'rh_rating_count_' . $post_id . '_2' );
		delete_transient( 'rh_rating_count_' . $post_id . '_3' );
		delete_transient( 'rh_rating_count_' . $post_id . '_4' );
		delete_transient( 'rh_rating_count_' . $post_id . '_5' );
	}

}

RH_Comments::init();