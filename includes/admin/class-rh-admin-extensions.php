<?php
/**
 * Recipe Hero Extensions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RH_Admin_Extensions' ) ) :

/**
 * RH_Admin_Extensions
 */
class RH_Admin_Extensions {

	public static function output() {

		delete_transient('recipe_hero_extensions_html' );

		if ( false === ( $extensions = get_transient( 'recipe_hero_extensions_html' ) ) ) {

			$raw_extensions = wp_remote_get(
				'http://recipehero.in/extensions/',
				array(
					'timeout'     => 10,
					'redirection' => 5,
					'sslverify'   => false
				)
			);

			if ( ! is_wp_error( $raw_extensions ) ) {

				$raw_extensions = wp_remote_retrieve_body( $raw_extensions );

				// Get Products
				$dom = new DOMDocument();
				libxml_use_internal_errors(true);
				$dom->loadHTML( $raw_extensions );

				$xpath  = new DOMXPath( $dom );
				$tags   = $xpath->query('//ul[@class="products"]');

				foreach ( $tags as $tag ) {
					$extensions = $tag->ownerDocument->saveXML( $tag );
					break;
				}

				$extensions = wp_kses_post( utf8_decode( $extensions ) );

				if ( $extensions ) {
					set_transient( 'recipe_hero_extensions_html', $extensions, 60*60*24*7 ); // Cached for a week
				}
			}
		}

		?>
		<div class="wrap recipe_hero recipe_hero_extensions_wrap">
			<h2><?php _e( 'Recipe Hero Extensions', 'recipe-hero' ); ?></h2>
			<?php
			/*
				<div id="notice" class="updated below-h2"><p><?php printf( __( 'Buying multiple extensions? <a href="%s">Check out the core extension bundle &rarr;</a>', 'recipe-hero' ), 'https://recipehero.in/extensions/bundle/' ); ?></p></div>
			*/
			?>
			<div id="notice" class="updated below-h2"><p><?php _e( 'The following are some extensions you can purchase to extend Recipe Hero in awesome and exciting ways!', 'recipe-hero' ); ?></p></div>
			<?php echo $extensions; ?>
		</div>
		<?php

	}

}

endif;