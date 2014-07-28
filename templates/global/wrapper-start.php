<?php
/**
 * Content Wrapper Start Templates
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @version 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $rh_general_options;

// Current WordPress Template Chosen
$template = get_option( 'template' );

$remove_char = array( '#', '.' );

if ( isset( $rh_general_options['main_content_class'] ) ) {

	$main_content_class_after = str_replace( $remove_char, "", $rh_general_options['main_content_class'] );

} else {

	$main_content_class_after = '';

}

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" class="' . $main_content_class_after . '">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" class="' . $main_content_class_after . '">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" class="entry-content twentythirteen' . $main_content_class_after . '">';
		break;
	case 'twentyfourteen' :
		echo '<div id="primary" class="content-area"><div id="content" class="site-content twentyfourteen' . $main_content_class_after . '"><div class="tfrh">';
		break;
	default :
		echo '<div id="container"><div id="content" class="content ' . $main_content_class_after;
		if ( is_search() ) {
			echo ' recipe-search';
		}
		echo '" role="main">';
		break;
}