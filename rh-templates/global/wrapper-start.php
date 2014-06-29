<?php
/**
 * Content Wrapper Start Templates
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Current WordPress Template Chosen
$template = get_option( 'template' );

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" class="' . str_replace( $remove_char, "", recipe_hero_get_option( 'rh-content-class', 'recipe-hero-options' ) ) . '">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" class="' . str_replace( $remove_char, "", recipe_hero_get_option( 'rh-content-class', 'recipe-hero-options' ) ) . '">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" class="entry-content twentythirteen' . str_replace( $remove_char, "", recipe_hero_get_option( 'rh-content-class', 'recipe-hero-options' ) ) . '">';
		break;
	case 'twentyfourteen' :
		echo '<div id="primary" class="content-area"><div id="content" class="site-content twentyfourteen' . str_replace( $remove_char, "", recipe_hero_get_option( 'rh-content-class', 'recipe-hero-options' ) ) . '"><div class="tfrh">';
		break;
	default :
		$remove_char = array( '#', '.' );
		echo '<div id="container"><div id="content" class="content ' . str_replace( $remove_char, "", recipe_hero_get_option( 'rh-content-class', 'recipe-hero-options' ) );
		if ( is_search() ) {
			echo ' recipe-search';
		}
		echo '" role="main">';
		break;
}