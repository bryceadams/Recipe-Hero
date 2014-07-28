<?php
/**
 * Recipe Single Comments
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( comments_open() || get_comments_number() ) {

	comments_template( '/comments.php', true ); 

}