<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'recipe_here_before_single_recipe' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="http://scheme.org/Recipe" id="recipe-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action( 'recipe_hero_single_recipe_content') ?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_recipe' ); ?>