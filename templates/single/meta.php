<?php
/**
 * Recipe Single Meta
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$date = get_the_date();
?>

<div class="recipe-single-meta">

	<div class="date updated">
		<meta itemprop="datePublished" content="<?php echo get_the_date( 'c' ); ?>">
		<span class="dashicons dashicons-clock"></span> <?php echo $date; ?>
	</div>
	
	<div class="vcard author" itemprop="author">
		<span class="dashicons dashicons-admin-users"></span> <span class="fn"><?php echo the_author_posts_link(); ?></span>
	</div>
	
	<div class="comments-link">
		 <meta itemprop="interactionCount" content="UserComments:<?php comments_number( '0', '1','%' ); ?>" />
		<span class="dashicons dashicons-testimonial"></span> <a href="#comments"><?php comments_number( __( '0 Comments', 'recipe-hero' ), __( '1 Comment', 'recipe-hero' ), __( '% Comments', 'recipe-hero' ) ); ?></a>
	</div>
	
	<?php if ( get_edit_post_link() ) { ?>
		
		<div class="edit-link">
			
			<span class="dashicons dashicons-welcome-write-blog"></span> <?php edit_post_link( __( 'Edit Recipe', 'recipe-hero' )); ?>
		
		</div>

	<?php } ?>

</div>