<?php
/**
 * A compilation of functions that output classes for template-part display
 * Note: This is experimental and looking for feedback. Personally I think this works well because it makes it easier to edit generic sets of classes from one place.
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @todo 	  Make all fitlerable
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Recipe Title
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 */

if ( ! function_exists( 'recipe_hero_class_recipe_title' ) ) {

	function recipe_hero_class_recipe_title() {
		
		$classes = 	array(
						'entry-title',
						'post-title',
					);

		$title_classes = implode( ' ', $classes );
		return $title_classes;

	}

}