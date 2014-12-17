<?php
/**
 * Content Wrapper Start Templates
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @version   1.0.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Current WordPress Template Chosen
$template = get_option( 'template' );

$remove_char = array( '#', '.' );

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" class="entry-content twentythirteen">';
		break;
	case 'twentyfourteen' :
		echo '<div id="primary" class="content-area"><div id="content" class="site-content twentyfourteen"><div class="tfrh">';
		break;
	case 'twentyfifteen' :
		echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
		break;
	case 'storefront' :
		echo '<div id="primary" class="content-area"><main id="main" class="site-main" role="main">';
		break;
	default :
		echo '<div id="container"><div id="content" class="content';
		if ( is_search() ) {
			echo ' recipe-search';
		}
		echo '" role="main">';
		break;
}