<?php
/**
 * Recipe Archive Title
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$get_title = get_the_title( $post->ID );

?>

<h1 class="recipe-archive-title entry-title post-title" itemprop="name">
	<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" title="<?php echo $get_title; ?>" rel="bookmark">
		<?php echo $get_title; ?>
	</a>
</h1>