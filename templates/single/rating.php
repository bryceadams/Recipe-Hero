<?php
/**
 * Recipe Single Rating
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$recipe = new RH_Recipe( get_the_ID() );

if ( get_option( 'recipe_hero_enable_review_rating' ) === 'no' ) {
	return;
}

$count   = $recipe->get_rating_count();
$average = $recipe->get_average_rating();

if ( $count > 0 ) : ?>

	<div class="recipe-hero-recipe-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'recipe-hero' ), $average ); ?>">
			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php _e( 'out of 5', 'recipe-hero' ); ?>
			</span>
		</div>
		<?php if ( comments_open() ) : ?><a href="#reviews" class="recipe-hero-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $count, 'recipe-hero' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?>)</a><?php endif ?>
	</div>

<?php endif; ?>