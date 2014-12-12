<?php
/**
 * Recipe Single Review / Comment
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php echo get_avatar( $comment, apply_filters( 'recipe_hero_review_gravatar_size', '60' ), '', get_comment_author() ); ?>

		<div class="comment-text">

			<?php if ( $rating && get_option( 'recipe_hero_enable_review_rating' ) == 'yes' ) : ?>
					
				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'recipe-hero' ), $rating ) ?>">
					
					<?php
					for ( $rating_count = 1; $rating_count <= $rating; $rating_count++ ) {
						echo '<span class="dashicons dashicons-star-filled"></span>';
					}
					for ( $rating_count = $rating; $rating_count <= 4; $rating_count++ ) {
						echo '<span class="dashicons dashicons-star-empty"></span>';
					}
					?>

					<div style="display:none;" itemprop="ratingValue"><?php echo $rating; ?></div>

				</div>

			<?php endif; ?>

			<?php if ( $comment->comment_approved == '0' ) : ?>

				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'recipe-hero' ); ?></em></p>

			<?php else : ?>

				<p class="meta">
					<strong itemprop="author"><?php comment_author(); ?></strong> 
					<span class="time">(<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( __( get_option( 'date_format' ), 'recipe-hero' ) ); ?></time>)</span>
				</p>

			<?php endif; ?>

			<div itemprop="description" class="description"><?php comment_text(); ?></div>
		</div>
	</div>