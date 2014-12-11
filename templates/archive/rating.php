<?php
/**
 * Archive / loop display rating
 *
 * @package   	Recipe Hero
 * @author    	Captain Theme <info@captaintheme.com>
 * @version 	1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$recipe = new RH_Recipe( $post->ID );

if ( get_option( 'recipe_hero_enable_review_rating' ) === 'no' )
	return;
?>

<?php if ( $rating_html = $recipe->get_rating_html() ) : ?>
	<?php echo $rating_html; ?>
<?php endif; ?>
