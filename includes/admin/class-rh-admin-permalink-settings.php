<?php
/**
 * Adds settings to the permalinks admin settings page.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since 	  1.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RH_Admin_Permalink_Settings' ) ) :

/**
 * RH_Admin_Permalink_Settings Class
 */
class RH_Admin_Permalink_Settings {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		$this->settings_init();
		$this->settings_save();
	}

	/**
	 * Init our settings
	 */
	public function settings_init() {
		// Add a section to the permalinks page
		add_settings_section( 'recipe-hero-permalink', __( 'Recipe permalink base', 'recipe-hero' ), array( $this, 'settings' ), 'permalink' );

		// Add our settings
		add_settings_field(
			'recipe_hero_recipe_cuisine_slug',      	// id
			__( 'Recipe cuisine base', 'recipe-hero' ), 	// setting title
			array( $this, 'recipe_cuisine_slug_input' ),  // display callback
			'permalink',                 				// settings page
			'optional'                  				// settings section
		);

		// Add our settings
		add_settings_field(
			'recipe_hero_recipe_course_slug',      	// id
			__( 'Recipe course base', 'recipe-hero' ), 	// setting title
			array( $this, 'recipe_course_slug_input' ),  // display callback
			'permalink',                 				// settings page
			'optional'                  				// settings section
		);
	}

	/**
	 * Show a slug input box.
	 */
	public function recipe_cuisine_slug_input() {
		$permalinks = get_option( 'recipe_hero_permalinks' );
		?>
		<input name="recipe_hero_recipe_cuisine_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['cuisine_base'] ) ) echo esc_attr( $permalinks['cuisine_base'] ); ?>" placeholder="<?php echo _x('recipe-cuisine', 'slug', 'recipe-hero') ?>" />
		<?php
	}

	public function recipe_course_slug_input() {
		$permalinks = get_option( 'recipe_hero_permalinks' );
		?>
		<input name="recipe_hero_recipe_course_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['course_base'] ) ) echo esc_attr( $permalinks['course_base'] ); ?>" placeholder="<?php echo _x('recipe-course', 'slug', 'recipe-hero') ?>" />
		<?php
	}

	/**
	 * Show the settings
	 */
	public function settings() {
		echo wpautop( __( 'These settings control the permalinks used for recipes. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'recipe-hero' ) );

		$permalinks = get_option( 'recipe_hero_permalinks' );
		$recipe_permalink = $permalinks['recipe_base'];

		// Get shop page
		$shop_page_id 	= rh_get_page_id( 'recipes' );
		$base_slug 		= urldecode( ( $shop_page_id > 0 && get_post( $shop_page_id ) ) ? get_page_uri( $shop_page_id ) : _x( 'shop', 'default-slug', 'recipe-hero' ) );
		$recipe_base 	= _x( 'recipe', 'default-slug', 'recipe-hero' );

		$structures = array(
			0 => '',
			1 => '/' . trailingslashit( $recipe_base ),
			2 => '/' . trailingslashit( $base_slug ),
		);
		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th><label><input name="recipe_permalink" type="radio" value="<?php echo $structures[0]; ?>" class="rhtog" <?php checked( $structures[0], $recipe_permalink ); ?> /> <?php _e( 'Default', 'recipe-hero' ); ?></label></th>
					<td><code><?php echo home_url(); ?>/?recipe=sample-recipe</code></td>
				</tr>
				<tr>
					<th><label><input name="recipe_permalink" type="radio" value="<?php echo $structures[1]; ?>" class="rhtog" <?php checked( $structures[1], $recipe_permalink ); ?> /> <?php _e( 'Recipe', 'recipe-hero' ); ?></label></th>
					<td><code><?php echo home_url(); ?>/<?php echo $recipe_base; ?>/sample-recipe/</code></td>
				</tr>
				<?php if ( $shop_page_id ) : ?>
					<tr>
						<th><label><input name="recipe_permalink" type="radio" value="<?php echo $structures[2]; ?>" class="rhtog" <?php checked( $structures[2], $recipe_permalink ); ?> /> <?php _e( 'Recipes base', 'recipe-hero' ); ?></label></th>
						<td><code><?php echo home_url(); ?>/<?php echo $base_slug; ?>/sample-recipe/</code></td>
					</tr>
				<?php endif; ?>
				<tr>
					<th><label><input name="recipe_permalink" id="recipe_hero_custom_selection" type="radio" value="custom" class="tog" <?php checked( in_array( $recipe_permalink, $structures ), false ); ?> />
						<?php _e( 'Custom Base', 'recipe-hero' ); ?></label></th>
					<td>
						<input name="recipe_permalink_structure" id="recipe_hero_permalink_structure" type="text" value="<?php echo esc_attr( $recipe_permalink ); ?>" class="regular-text code"> <span class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'recipe-hero' ); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
		<script type="text/javascript">
			jQuery(function(){
				jQuery('input.rhtog').change(function() {
					jQuery('#recipe_hero_permalink_structure').val( jQuery(this).val() );
				});

				jQuery('#recipe_hero_permalink_structure').focus(function(){
					jQuery('#recipe_hero_custom_selection').click();
				});
			});
		</script>
		<?php
	}

	/**
	 * Save the settings
	 */
	public function settings_save() {
		if ( ! is_admin() ) {
			return;
		}

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page
		if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['cuisine_base'] ) || isset( $_POST['course_base'] ) && isset( $_POST['recipe_permalink'] ) ) {
			// Cat and tag bases
			$recipe_hero_recipe_cuisine_slug  	= rh_clean( $_POST['recipe_hero_recipe_cuisine_slug'] );
			$recipe_hero_recipe_course_slug 	= rh_clean( $_POST['recipe_hero_recipe_course_slug'] );

			$permalinks = get_option( 'recipe_hero_permalinks' );

			if ( ! $permalinks ) {
				$permalinks = array();
			}

			$permalinks['cuisine_base'] 	= untrailingslashit( $recipe_hero_recipe_cuisine_slug );
			$permalinks['course_base'] 		= untrailingslashit( $recipe_hero_recipe_course_slug );

			// Recipe base
			$recipe_permalink = rh_clean( $_POST['recipe_permalink'] );

			if ( $recipe_permalink == 'custom' ) {
				// Get permalink without slashes
				$recipe_permalink = trim( rh_clean( $_POST['recipe_permalink_structure'] ), '/' );

				// Prepending slash
				$recipe_permalink = '/' . $recipe_permalink;
			} elseif ( empty( $recipe_permalink ) ) {
				$recipe_permalink = false;
			}

			$permalinks['recipe_base'] = untrailingslashit( $recipe_permalink );

			// Shop base may require verbose page rules if nesting pages
			$recipe_page_id   = rh_get_page_id( 'recipes' );
			$recipes_permalink = ( $recipe_page_id > 0 && get_post( $recipe_page_id ) ) ? get_page_uri( $recipe_page_id ) : _x( 'shop', 'default-slug', 'recipe-hero' );
			if ( $recipe_page_id && trim( $permalinks['recipe_base'], '/' ) === $recipes_permalink ) {
				$permalinks['use_verbose_page_rules'] = true;
			}

			update_option( 'recipe_hero_permalinks', $permalinks );
		}
	}
}

endif;

return new RH_Admin_Permalink_Settings();
