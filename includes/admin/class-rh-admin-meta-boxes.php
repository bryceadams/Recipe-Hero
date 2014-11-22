<?php
/**
 * Recipe Hero Meta Boxes
 *
 * Sets up the write panels used by recipes
 *
 * As of 1.0.0, most are done using CMB2. This is planned to change in the future, but the following in this file are currently set up by Recipe Hero.
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

/**
 * WC_Admin_Meta_Boxes
 */
class RH_Admin_Meta_Boxes {

	private static $meta_box_errors = array();

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 30 );

		// Save Meta Boxes - @todo do it the WC way so it only affects recipes
		add_action( 'save_post', array( $this, 'gallery_save' ), 20, 2 );

	}

	/**
	 * Add RH Meta boxes
	 */
	public function add_meta_boxes() {
	
		// Add Recipe Gallery Metabox
		add_meta_box( 'recipe-hero-recipe-images', __( 'Recipe Gallery', 'recipe-hero' ), array( $this, 'gallery_output' ), 'recipe', 'side' );
	
		// Remove Metaboxes
		remove_meta_box( 'pageparentdiv', 'recipe', 'side' );
		remove_meta_box( 'commentstatusdiv', 'recipe', 'normal' );

	}


	/**
	 * Output the metabox
	 */
	public function gallery_output( $post ) {

		?>
		<div id="recipe_images_container">
			<ul class="recipe_images">
				<?php
					if ( metadata_exists( 'post', $post->ID, '_recipe_image_gallery' ) ) {
						$recipe_image_gallery = get_post_meta( $post->ID, '_recipe_image_gallery', true );
					} else {
						// Backwards compat
						$attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_exclude_image&meta_value=0' );
						$attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
						$recipe_image_gallery = implode( ',', $attachment_ids );
					}

					$attachments = array_filter( explode( ',', $recipe_image_gallery ) );

					if ( $attachments ) {
						foreach ( $attachments as $attachment_id ) {
							echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
								' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . __( 'Delete image', 'woocommerce' ) . '">' . __( 'Delete', 'woocommerce' ) . '</a></li>
								</ul>
							</li>';
						}
					}
				?>
			</ul>

			<input type="hidden" id="recipe_image_gallery" name="recipe_image_gallery" value="<?php echo esc_attr( $recipe_image_gallery ); ?>" />

		</div>
		<p class="add_recipe_images hide-if-no-js">
			<a href="#" data-choose="<?php _e( 'Add Images to Recipe Gallery', 'woocommerce' ); ?>" data-update="<?php _e( 'Add to gallery', 'woocommerce' ); ?>" data-delete="<?php _e( 'Delete image', 'woocommerce' ); ?>" data-text="<?php _e( 'Delete', 'woocommerce' ); ?>"><?php _e( 'Add recipe gallery images', 'woocommerce' ); ?></a>
		</p>
		<?php
	}

	/**
	 * Save meta box data
	 */
	public static function gallery_save( $post_id, $post ) {
		$attachment_ids = array_filter( explode( ',', rh_clean( $_POST['recipe_image_gallery'] ) ) );

		update_post_meta( $post_id, '_recipe_image_gallery', implode( ',', $attachment_ids ) );
	}

}

new RH_Admin_Meta_Boxes();