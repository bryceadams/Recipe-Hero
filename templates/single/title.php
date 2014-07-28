<?php
/**
 * Recipe Single Title
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

?>

<h1 class="recipe-single-title <?php echo recipe_hero_class_recipe_title(); ?>" itemprop="name">
	<?php echo get_the_title( $post->ID ); ?>
</h1>