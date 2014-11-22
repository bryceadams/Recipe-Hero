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

		<?php
			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = esc_url( get_permalink( $post->ID ) );
			$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'archive_recipe_large_thumbnail_size', 'recipe_single' ), array(
				'title' => $image_title
				) );

			echo apply_filters( 'recipe_hero_archive_recipe_image_html', sprintf( '<a href="%s" itemprop="image" class="recipe-hero-main-image" title="%s">%s</a>', $image_link, $image_title, $image ), $post->ID ); ?>
		
	</div>

<?php
}