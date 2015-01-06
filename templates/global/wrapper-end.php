<?php
/**
 * Content Wrapper End Templates
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @version   1.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Current WordPress Template Chosen
$template = get_option( 'template' );

switch( $template ) {
	case 'twentyeleven' :
		echo '</div></div>';
		break;
	case 'twentytwelve' :
		echo '</div></div>';
		break;
	case 'twentythirteen' :
		echo '</div></div>';
		break;
	case 'twentyfourteen' :
		echo '</div></div></div>';
		get_sidebar( 'content' );
		break;
	case 'twentyfifteen' :
		echo '</div></div>';
		break;
	case 'storefront' :
		echo '</main></div>';
		break;
	case 'point' :
		echo '</div></div>';
		break;
	default :
		echo '</div></div>';
		break;
}