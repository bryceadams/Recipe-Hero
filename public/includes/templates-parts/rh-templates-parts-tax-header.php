<?php
/**
 * Recipe Archive Taxonomy Header Titles
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

/**
 * Recipe Archive Titles (Cat / Tax etc.)
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.7.0
 */		

	function recipe_hero_archive_tax_title() { ?>

		
			<?php
				if ( is_tax( 'cuisine' ) ) {
					$cuisine_text = __( 'Cuisine' );
					echo '<h1 class="archive-title">';
					echo single_term_title( $cuisine_text . ': ' );
					echo '</h1>';
				} elseif ( is_tax( 'course' ) ) {
					$course_text = __( 'Course' );
					echo '<h1 class="archive-title">';
					echo single_term_title( $course_text . ': ' );
					echo '</h1>';
				} else { }
			?>
		</h1>

	<?php }

	function recipe_hero_archive_tax_desc() {

			if ( is_tax() ) {

				$term_description = term_description();

				if ( ! empty( $term_description ) ) {
					echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $term_description . '</div>' );
				}

			}
	
	}