<?php
/**
 * Abstract Recipe Class
 *
 * The Recipe Hero recipe class handles individual recipe data.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.2
 */
class RH_Recipe {

	/** @var int The product (post) ID. */
	public $id;

	/** @var object The actual post object. */
	public $post;

	/**
	 * Constructor gets the post object and sets the ID for the loaded product.
	 *
	 */
	public function __construct( $recipe ) {

		if ( is_numeric( $recipe ) ) {
			$this->id   = absint( $recipe );
			$this->post = get_post( $this->id );
		} elseif ( $recipe instanceof RH_Recipe ) {
			$this->id   = absint( $recipe->id );
			$this->post = $recipe;
		} elseif ( $recipe instanceof WP_Post || isset( $recipe->ID ) ) {
			$this->id   = absint( $recipe->ID );
			$this->post = $recipe;
		}
	}

	/**
	 * __isset function.
	 *
	 * @param mixed $key
	 * @return bool
	 */
	public function __isset( $key ) {
		return metadata_exists( 'post', $this->id, '_' . $key );
	}

	/**
	 * __get function.
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function __get( $key ) {

		$value = get_post_meta( $this->id, '_' . $key, true );

		return $value;
	}

	/**
	 * Get the product's post data.
	 *
	 * @return object
	 */
	public function get_post_data() {
		return $this->post;
	}

	/**
	 * get_gallery_attachment_ids function.
	 *
	 * @return array
	 */
	public function get_gallery_attachment_ids() {

		if ( get_post_meta( $this->id, '_recipe_image_gallery', true )  ) {
			$recipe_image_gallery = get_post_meta( $this->id, '_recipe_image_gallery', true );
		} else {
			$recipe_image_gallery = '';
		}

		$attachments = array_filter( explode( ',', $recipe_image_gallery ) );

		return $attachments;

	}

	/**
	 * Wrapper for get_permalink
	 *
	 * @return string
	 */
	public function get_permalink() {
		return get_permalink( $this->id );
	}


	/**
	 * Returns whether or not the recipe post exists.
	 *
	 * @return bool
	 */
	public function exists() {
		return empty( $this->post ) ? false : true;
	}

	/**
	 * Get the title of the post.
	 *
	 * @return string
	 */
	public function get_title() {
		return apply_filters( 'recipe_hero_recipe_title', $this->post ? $this->post->post_title : '', $this );
	}

	/**
	 * Returns the recipe course.
	 *
	 * @param string $sep (default: ')
	 * @param mixed '
	 * @param string $before (default: '')
	 * @param string $after (default: '')
	 * @return string
	 */
	public function get_course( $sep = ', ', $before = '', $after = '' ) {
		return get_the_term_list( $this->id, 'course', $before, $sep, $after );
	}

	/**
	 * Returns the recipe cuisine.
	 *
	 * @param string $sep (default: ', ')
	 * @param string $before (default: '')
	 * @param string $after (default: '')
	 * @return array
	 */
	public function get_cuisine( $sep = ', ', $before = '', $after = '' ) {
		return get_the_term_list( $this->id, 'cuisine', $before, $sep, $after );
	}

	

	/**
	 * Gets the main product image ID.
	 *
	 * @return int
	 */
	public function get_image_id() {

		if ( has_post_thumbnail( $this->id ) ) {
			$image_id = get_post_thumbnail_id( $this->id );
		} elseif ( ( $parent_id = wp_get_post_parent_id( $this->id ) ) && has_post_thumbnail( $parent_id ) ) {
			$image_id = get_post_thumbnail_id( $parent_id );
		} else {
			$image_id = 0;
		}

		return $image_id;
	}

	/**
	 * Returns the main recipe image
	 *
	 * @param string $size (default: 'recipe_thumbnail')
	 * @return string
	 */
	public function get_image( $size = 'recipe_thumbnail', $attr = array() ) {
		$image = '';

		if ( has_post_thumbnail( $this->id ) ) {
			$image = get_the_post_thumbnail( $this->id, $size, $attr );
		} else {
			$image = '';
		}

		return $image;
	}

	/**
	 * Get the average rating of recipe.
	 *
	 * @return string
	 */
	public function get_average_rating() {

		if ( false === ( $average_rating = get_transient( 'rh_average_rating_' . $this->id ) ) ) {

			global $wpdb;

			$average_rating = '';
			$count          = $this->get_rating_count();

			if ( $count > 0 ) {

				$ratings = $wpdb->get_var( $wpdb->prepare("
					SELECT SUM(meta_value) FROM $wpdb->commentmeta
					LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
					WHERE meta_key = 'rating'
					AND comment_post_ID = %d
					AND comment_approved = '1'
					AND meta_value > 0
				", $this->id ) );

				$average_rating = number_format( $ratings / $count, 2 );
			}

			set_transient( 'rh_average_rating_' . $this->id, $average_rating, YEAR_IN_SECONDS );
		}

		return $average_rating;
	}

	/**
	 * Get the total amount (COUNT) of ratings.
	 *
	 * @param  int $value Optional. Rating value to get the count for. By default
	 *                              returns the count of all rating values.
	 * @return int
	 */
	public function get_rating_count( $value = null ) {

		$value = intval( $value );
		$value_suffix = $value ? '_' . $value : '';

		if ( false === ( $count = get_transient( 'rh_rating_count_' . $this->id . $value_suffix ) ) ) {

			global $wpdb;

			$where_meta_value = $value ? $wpdb->prepare( " AND meta_value = %d", $value ) : " AND meta_value > 0";

			if ( get_option( 'recipe_hero_enable_review_rating' ) == 'yes' ) {

				$count = $wpdb->get_var( $wpdb->prepare("
					SELECT COUNT(meta_value) FROM $wpdb->commentmeta
					LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
					WHERE meta_key = 'rating'
					AND comment_post_ID = %d
					AND comment_approved = '1'
				", $this->id ) . $where_meta_value );

			} else {

				$count = $wpdb->get_var( $wpdb->prepare("
					SELECT COUNT(*) FROM $wpdb->comments
					WHERE comment_parent = 0
					AND comment_post_ID = %d
					AND comment_approved = '1'
				", $this->id ) );

			}

			set_transient( 'rh_rating_count_' . $this->id . $value_suffix, $count, YEAR_IN_SECONDS );
		}

		return $count;
	}

	/**
	 * Returns the recipe rating in html format.
	 *
	 * @param string $rating (default: '')
	 * @return string
	 */
	public function get_rating_html( $rating = null ) {

		if ( ! is_numeric( $rating ) ) {
			$rating = $this->get_average_rating();
		}

		if ( $rating > 0 ) {

			$rating_html  = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'recipe-hero' ), $rating ) . '">';

			$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'recipe-hero' ) . '</span>';

			$rating_html .= '</div>';

			return $rating_html;
		}

		return '';
	}

}
