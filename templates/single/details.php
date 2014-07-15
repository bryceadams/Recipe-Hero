<?php
/**
 * Recipe Single Details
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Variables
global $post;
global $rh_labels_options;

$serves 		= get_post_meta( $post->ID, '_recipe_hero_detail_serves', true );
$serves_type 	= get_post_meta( $post->ID, '_recipe_hero_detail_serves_type', true );
$equipment 		= get_post_meta ( $post->ID, '_recipe_hero_detail_equipment', false );
$prep_time 		= recipe_hero_convert_minute_hour ( get_post_meta ( $post->ID, '_recipe_hero_detail_prep_time', true ) );
$cook_time 		= recipe_hero_convert_minute_hour ( get_post_meta ( $post->ID, '_recipe_hero_detail_cook_time', true ) );
$total_time 	= recipe_hero_convert_minute_hour ( recipe_hero_calc_total_cook_time() ); ?>

<div class="recipe-single-details">

	<div class="rh-grid">

		<?php if ( $serves ) { ?>

		<div class="serves unit w-1-4">
			<strong>
				<?php if ( $rh_labels_options['label_serves'] ) {
						echo $rh_labels_options['label_serves'];
					} else {
						_e( 'Serves', 'recipe-hero' );
					} ?>
			</strong> <span itemprop="recipeYield"><?php echo $serves; ?> <?php echo $serves_type; ?></span>
		</div>

		<?php } ?>

		<?php if ( $equipment ) { ?>
			<div class="equipment unit w-1-4">
				<strong>
					<?php if ( $rh_labels_options['label_equipment'] ) {
						echo $rh_labels_options['label_equipment'];
						} else {
							_e( 'Equipment', 'recipe-hero' );
						} ?>
				</strong>
				<?php
				foreach ($equipment as $equipment_item ) {
					foreach($equipment_item as $item) {
					    echo '<div class="equipment-item">';
					    echo $item;
					    echo '</div>';
					}
				}
				?>
			</div>
		<?php } ?>

		<?php if ( $prep_time ) { ?>
			<div class="prep-time unit w-1-4">
				<strong>
					<?php if ( $rh_labels_options['label_prep'] ) {
						echo $rh_labels_options['label_prep'];
						} else {
							_e( 'Prep Time', 'recipe-hero' );
						} ?>
				</strong> <meta itemprop="prepTime" content="<?php echo recipe_hero_schema_prep_time(); ?>">
				<div class="the-time"><span class="dashicons dashicons-clock"></span> <?php echo $prep_time; ?></div>
			</div>
		<?php } ?>

		<?php if ( $cook_time ) { ?>

			<div class="cook-time unit w-1-4">
				<strong>
					<?php if ( $rh_labels_options['label_cook'] ) {
						echo $rh_labels_options['label_cook'];
						} else {
							_e( 'Cook Time', 'recipe-hero' );
						} ?>
				</strong> <meta itemprop="cookTime" content="<?php echo recipe_hero_schema_cook_time(); ?>">
				<div class="the-time"><span class="dashicons dashicons-clock"></span> <?php echo $cook_time; ?></div>
				<meta itemprop="totalTime" content="<?php echo recipe_hero_schema_total_time(); ?>">
			</div>

		<?php } ?>

	</div>

	<hr class="recipe-single-seperator" />

</div><!-- .recipe-single-details -->
