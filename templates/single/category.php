<?php
/**
 * Recipe Single Cuisine / Course (Category)
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version 	  0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
global $rh_labels_options;

$cuisine_terms = wp_get_object_terms($post->ID, 'cuisine');
$course_terms = wp_get_object_terms($post->ID, 'course');
	
if ( ! empty ( $cuisine_terms ) ) {
	if ( ! is_wp_error ( $cuisine_terms ) ) {
		$cuisine = '<ul>';
		foreach ( $cuisine_terms as $term ) {
			$cuisine .= '<li><a href="' . get_term_link ( $term->slug, 'cuisine' ) . '">' . $term->name . '</a></li>';
			$cuisine_meta = $term->name . ', ';
		}
		$cuisine .= '</ul>';
	}
}

if ( ! empty ( $course_terms ) ) {
	if ( ! is_wp_error ( $course_terms ) ) {
		$course = '<ul>';
		foreach ( $course_terms as $term ) {
			$course .= '<li><a href="' . get_term_link ( $term->slug, 'course' ) . '">' . $term->name . '</a></li>';
			$course_meta = $term->name . ', ';
		}
		$course .= '</ul>';
	}
}

?>

<div class="recipe-single-tax">

	<?php if ( isset ( $cuisine ) ) { ?>

		<div class="cuisine">
			<meta itemprop="recipeCuisine" content="<?php echo $cuisine_meta; ?>">
			<strong>
			<?php if ( ! empty( $rh_labels_options['label_cuisine'] ) ) {
				echo $rh_labels_options['label_cuisine'];
			} else {
				_e( 'Cuisine', 'recipe-hero' );
			} ?></strong>
			<?php echo $cuisine; ?>
		</div>

	<?php } ?>

	<?php if ( isset ( $course ) ) { ?>

		<div class="course">
			<meta itemprop="recipeCategory" content="<?php echo $course_meta; ?>">	
			<strong>
			<?php if ( ! empty( $rh_labels_options['label_course'] ) ) {
				echo $rh_labels_options['label_course'];
			} else {
				_e( 'Course', 'recipe-hero' );
			} ?></strong>
			<?php echo $course; ?>
		</div>
		
	<?php } ?>

</div>