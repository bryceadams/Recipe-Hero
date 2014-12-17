<?php
/**
 * Recipe Single Photo
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$recipe = new RH_Recipe( $post->ID );

$photo = get_the_post_thumbnail( $post->ID, 'recipe_single', array( 'itemprop' => 'image' ) );
$thumb = get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'recipe-schema-thumb', 'itemprop' => 'image' ) );

?>

<div class="images">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_recipe_large_thumbnail_size', 'recipe_single' ), array(
				'title' => $image_title
				) );

			$attachment_count = count( $recipe->get_gallery_attachment_ids() );

			$gallery = 'recipe-gallery';

			echo apply_filters( 'recipe_hero_single_recipe_image_html', sprintf( '<a href="%s" itemprop="image" class="recipe-hero-main-image zoom ' . $gallery . '" title="%s">%s</a>', $image_link, $image_title, $image ), $post->ID );
			echo $thumb; // Don't Remove (Google Meta Data)

		} else {

			// No image

		}
	?>

	<?php do_action( 'recipe_hero_recipe_thumbnails' ); ?>

</div>