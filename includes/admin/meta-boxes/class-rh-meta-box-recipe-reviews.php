<?php
/**
 * Recipe Reviews
 *
 * Functions for displaying the recipe reviews data meta box.
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
 * RH_Meta_Box_Recipe_Reviews Class
 */
class RH_Meta_Box_Recipe_Reviews {

	/**
	 * Output the metabox
	 */
	public static function output( $comment ) {
		wp_nonce_field( 'recipe_hero_save_data', 'recipe_hero_meta_nonce' );

		$current = get_comment_meta( $comment->comment_ID, 'rating', true );
		?>
		<select name="rating" id="rating">
			<?php for ( $rating = 0; $rating <= 5; $rating++ ) {
				echo sprintf( '<option value="%1$s"%2$s>%1$s</option>', $rating, selected( $current, $rating, false ) );
			} ?>
		</select>
		<?php
	}

	/**
	 * Save meta box data
	 */
	public static function save( $location, $comment_id ) {
		// Not allowed, return regular value without updating meta
		if ( ! wp_verify_nonce( $_POST['recipe_hero_meta_nonce'], 'recipe_hero_save_data' ) && ! isset( $_POST['rating'] ) ) {
			return $location;
		}

		// Update meta
		update_comment_meta(
			$comment_id,
			'rating',
			intval( $_POST['rating'] )
		);

		// Return regular value after updating
		return $location;
	}
}
