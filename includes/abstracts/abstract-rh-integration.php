<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Recipe Hero Integration class
 *
 * Extended by individual integrations to offer additional functionality.
 *
 * @class       RH_Integration
 * @extends     RH_Settings_API
 * @version     1.0.5
 * @package     Recipe Hero/Abstracts
 * @category    Abstract Class
 * @author      Recipe Hero
 */
abstract class RH_Integration extends RH_Settings_API {

	/**
	 * Admin Options
	 */
	public function admin_options() { ?>

		<h3><?php echo isset( $this->method_title ) ? $this->method_title : __( 'Settings', 'recipe-hero' ) ; ?></h3>

		<?php echo isset( $this->method_description ) ? wpautop( $this->method_description ) : ''; ?>

		<table class="form-table">
			<?php $this->generate_settings_html(); ?>
		</table>

		<!-- Section -->
		<div><input type="hidden" name="section" value="<?php echo $this->id; ?>" /></div>

		<?php
	}
}
