<?php
/**
 * Recipe Single Photo
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$photo = get_the_post_thumbnail( $post->ID, 'rh-recipe-single', array( 'itemprop' => 'image' ) );
$thumb = get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'recipe-schema-thumb', 'itemprop' => 'image' ) );

if ( has_post_thumbnail() ) { ?>
	
	<div class="recipe-single-photo">
		<?php echo $photo; ?>
		<?php echo $thumb; // Don't Remove (Google Meta Data) ?>
	</div>
	
<?php	
}
