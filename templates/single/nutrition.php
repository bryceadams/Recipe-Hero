<?php
/**
 * Recipe Single Nutrition
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$nutrition = get_post_meta ( $post->ID, '_recipe_hero_detail_nutrition', true );

if ( $nutrition ) { ?>

	<div class="recipe-single-nutrition" itemprop="nutrition" itemscope itemtype="http://schema.org/NutritionInformation">
		<strong><?php _e( 'Nutrition', 'recipe-hero' ); ?>:</strong> <?php echo $nutrition; ?>
	</div>

<?php }