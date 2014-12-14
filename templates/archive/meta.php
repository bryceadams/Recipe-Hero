<?php
/**
 * Recipe Archive Meta
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$date = get_the_date();

?>

<div class="recipe-archive-meta">

	<div class="date">
		<span class="dashicons dashicons-clock"></span> <?php echo $date; ?>
	</div>

	<div class="author">
		<span class="dashicons dashicons-admin-users"></span> <?php echo the_author_posts_link(); ?>
	</div>

	<?php recipe_hero_get_template( 'single/rating.php' ); ?>

	<?php if ( get_edit_post_link() ) { ?>

		<div class="edit-link">
			<span class="dashicons dashicons-welcome-write-blog"></span> <?php edit_post_link( __( 'Edit Recipe', 'recipe-hero' )); ?>
		</div>
		
	<?php } ?>

</div>