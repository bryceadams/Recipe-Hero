<?php
/**
 * Recipe Archive Photo
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$photo = get_the_post_thumbnail( $post->ID, 'recipe_single' );

if ( has_post_thumbnail() ) { ?>

	<div class="images">

		<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" title="<?php echo get_the_title( $post->ID ); ?>" rel="bookmark">
			<?php echo $photo; ?>
		</a>
		
	</div>

<?php
}