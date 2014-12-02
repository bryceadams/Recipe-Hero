<?php
/**
 * Recipe Photo Gallery Thumbnails
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$recipe = new RH_Recipe( $post->ID );

$attachment_ids = $recipe->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>
	<div class="thumbnails"><?php

		$loop = 0;
		$columns = apply_filters( 'recipe_hero_recipe_thumbnails_columns', 5 );

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'recipe-gallery' );

			if ( $loop == 0 || $loop % $columns == 0 ) {
				$classes[] = 'first';
			}

			if ( ( $loop + 1 ) % $columns == 0 ) {
				$classes[] = 'last';
			}

			$classes[] = 'columns-' . $columns;

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link ) {
				continue;
			}

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_recipe_small_thumbnail_size', 'recipe_thumbnail' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo apply_filters( 'recipe_hero_single_recipe_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?></div>
	<?php
}