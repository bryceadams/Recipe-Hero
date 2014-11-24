<p>
	<?php _e( 'Sorry, there are no recipes to show!', 'recipe-hero' ); ?>
	<?php if ( current_user_can( 'publish_posts' ) ) {
		echo '<a href="' . admin_url( '/post-new.php?post_type=recipe' ) . '">';
		_e( 'Add Your First Recipe!', 'recipe-hero' );
		echo '</a>';
	} else {
		_e( 'We have some coming soon though!', 'recipe-hero' );
	} ?>
</p>