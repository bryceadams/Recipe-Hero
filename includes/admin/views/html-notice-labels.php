<?php
/**
 * Admin View: Notice - Labels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div id="message" class="updated recipe-hero-message rh-connect">
	<p><?php _e( '<strong>Notice:</strong> It looks like you used to have <strong>Recipe Hero Labels</strong> configured. In 1.0 they were removed, but there\'s a free extension that allows you to easily change the labels.', 'recipe-hero' ); ?></p>
	<p class="submit"><a href="http://wordpress.org/plugins/recipe-hero-labels" class="rh-update-now button-primary" target="_blank"><?php _e( 'Download', 'recipe-hero' ); ?></a> <a href="<?php echo esc_url( add_query_arg( 'dismiss_rh_labels_notice', 'true', admin_url( 'admin.php?page=rh-settings' ) ) ); ?>" class="rh-update-now button-primary"><?php _e( 'Cool - Understood!', 'recipe-hero' ); ?></a></p>
</div>