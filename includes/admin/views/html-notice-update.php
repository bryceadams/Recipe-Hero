<?php
/**
 * Admin View: Notice - Update
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div id="message" class="updated recipe-hero-message rh-connect">
	<p><?php _e( '<strong>Recipe Hero Data Update Required</strong> &#8211; We just need to update your install to the latest version!', 'recipe-hero' ); ?></p>
	<p class="submit"><a href="<?php echo esc_url( add_query_arg( 'do_update_recipe_hero', 'true', admin_url( 'admin.php?page=rh-settings' ) ) ); ?>" class="rh-update-now button-primary"><?php _e( 'Run the updater', 'recipe-hero' ); ?></a></p>
</div>
<script type="text/javascript">
	jQuery('.rh-update-now').click('click', function(){
		var answer = confirm( '<?php _e( 'It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', 'recipe-hero' ); ?>' );
		return answer;
	});
</script>