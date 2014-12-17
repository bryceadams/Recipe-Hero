<?php
/**
 * Recipe Single Rating
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$recipe = new RH_Recipe( get_the_ID() );

$count   = $recipe->get_rating_count();
$average = $recipe->get_average_rating();

$link = is_archive() ? get_permalink( get_the_ID() ) . '#reviews' : '#reviews';

if ( get_option( 'recipe_hero_enable_review_rating' ) === 'no' ) {

	if ( comments_open() ) : ?>
	<span class="recipe-hero-recipe-rating">
		<span class="dashicons dashicons-testimonial"></span> <a href="<?php echo $link; ?>" rel="nofollow"><?php printf( _n( '%s Review', '%s Reviews', $count, 'recipe-hero' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?></a>
	</span>
	<?php endif;

	return;

}

if ( $count > 0 ) : ?>

	<span class="recipe-hero-recipe-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		
		<?php if ( comments_open() ) : ?>
			<span class="dashicons dashicons-testimonial"></span> <a href="<?php echo $link; ?>" rel="nofollow"><?php printf( _n( '%s Review', '%s Reviews', $count, 'recipe-hero' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?></a>
		<?php endif; ?>

		<span title="<?php printf( __( 'Rated %s out of 5', 'recipe-hero' ), $average ); ?>">
			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				(<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php _e( 'out of 5', 'recipe-hero' ); ?>)
			</span>
		</span>

	</span>

<?php endif; ?>