<?php
/**
 * Functions to load admin scripts / styles
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Recipe_Hero_Admin_Scripts {

	/**
	 * Constructor
	 */
	public function __construct () {
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	/**
	 * Register/queue frontend scripts.
	 *
	 * @access public
	 * @return void
	 */
	public function load_scripts() {

		global $post, $wp;

		// Register all scripts/styles for later use
		wp_register_script( 'numeric', plugins_url( '../assets/js/jquery.numeric.js', __FILE__ ), array( 'jquery' ), RECIPE_HERO_VERSION_NUMBER, true );

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'numeric' );

	}


}

new Recipe_Hero_Admin_Scripts();


/**
 * Initialized Numeric JS
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 */

if ( ! function_exists( 'recipe_hero_initialize_admin_numeric_js' ) ) {

	function recipe_hero_initialize_admin_numeric_js() { ?>

		<script type="text/javascript">

			jQuery(document).ready(function() {

				jQuery(".numeric").numeric();

			});

		</script>

	<?php
	}

}
add_action( 'admin_head', 'recipe_hero_initialize_admin_numeric_js' );