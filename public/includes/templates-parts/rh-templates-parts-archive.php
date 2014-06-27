<?php
/**
 * Recipe Archive Template Display Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

/**
 * Recipe Title
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_output_archive_title' ) ) {

	function recipe_hero_output_archive_title() {

		// Variables
		global $post;
		$get_title = get_the_title( $post->ID );

		$title = '<h1 class="recipe-archive-title ' . recipe_hero_class_recipe_title() . '" itemprop="name">';
		$title .= '<a href="' . get_permalink( $post->ID ) . '" title="' . $get_title . '" rel="bookmark">';
		$title .= $get_title;
		$title .= '</a></h1>';

		echo $title;

	}
	
}

/**
 * Recipe Meta: Author & Date
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 * @todo 	  Make 'By' fitlerable / an option
 */

if ( ! function_exists( 'recipe_hero_output_archive_meta' ) ) {

	function recipe_hero_output_archive_meta() {

		// Variables
		$date = get_the_date();
		?>

		<div class="recipe-archive-meta">

			<div class="date">
				<span class="dashicons dashicons-clock"></span> <?php echo $date; ?>
			</div>
			<div class="author">
				<span class="dashicons dashicons-admin-users"></span> <?php echo the_author_posts_link(); ?>
			</div>
			<div class="comments-link">
				<span class="dashicons dashicons-testimonial"></span> <a href="#comments"><?php comments_number( __( '0 Comments', 'recipe-hero' ), __( '1 Comment', 'recipe-hero' ), __( '% Comments', 'recipe-hero' ) ); ?></a>
			</div>
			<?php if ( get_edit_post_link() ) { ?>
				<div class="edit-link">
					<span class="dashicons dashicons-welcome-write-blog"></span> <?php edit_post_link( __( 'Edit Recipe', 'recipe-hero' )); ?>
				</div>
			<?php } ?>

		</div>
		
	<?php
	}

}

/**
 * Recipe Featured Image Photo
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_output_archive_photo' ) ) {

	function recipe_hero_output_archive_photo() {

		// Variables
		global $post;

		$photo = get_the_post_thumbnail();

		if ( has_post_thumbnail() ) {
			echo '<div class="recipe-archive-photo">';
			echo '<a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '" rel="bookmark">';
			echo $photo;
			echo '</a></div>';
		}

	}

}

/**
 * Recipe Cuisine / Course
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 * @todo 	  Make 'By' fitlerable / an option
 */

if ( ! function_exists( 'recipe_hero_output_archive_tax' ) ) {

	function recipe_hero_output_archive_tax() {

		// Variables
		global $post;

		$cuisine_terms = wp_get_object_terms($post->ID, 'cuisine');
			if(!empty($cuisine_terms)){
				if(!is_wp_error( $cuisine_terms )){
					$cuisine = '<ul>';
					foreach($cuisine_terms as $term){
						$cuisine .= '<li><a href="'.get_term_link($term->slug, 'cuisine').'">'.$term->name.'</a></li>'; 
					}
					$cuisine .= '</ul>';
				}
			}

		$course_terms = wp_get_object_terms($post->ID, 'course');
			if(!empty($course_terms)){
				if(!is_wp_error( $course_terms )){
					$course = '<ul>';
					foreach($course_terms as $term){
						$course .= '<li><a href="'.get_term_link($term->slug, 'course').'">'.$term->name.'</a></li>'; 
					}
					$course .= '</ul>';
				}
			}

			?>

		<div class="recipe-archive-tax">

			<?php if ( isset( $cuisine ) ) { ?>
				<div class="cuisine">
					<strong><?php _e( 'Cuisines', 'recipe-hero' ); ?>:</strong> <?php echo $cuisine; ?>
				</div>
			<?php } ?>

			<?php if ( isset ( $course ) ) { ?>
				<div class="course">	
					<strong><?php _e( 'Courses', 'recipe-hero' ); ?>:</strong> <?php echo $course; ?>
				</div>
			<?php } ?>

		</div>

	<?php
	}

}

/**
 * Recipe Content / Description
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_output_archive_description' ) ) {

	function recipe_hero_output_archive_description() {

		// Variables
		$description = get_the_content();

		if ( $description ) { ?>

			<div class="recipe-archive-content">

				<?php echo $description; ?>

			</div>

		<?php
		}

	}

}

/**
 * Recipe Details / Information
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  0.5.0
 */

if ( ! function_exists( 'recipe_hero_output_archive_details' ) ) {

	function recipe_hero_output_archive_details() {

		// Variables
		global $post;
		$serves 	= get_post_meta( $post->ID, '_recipe_hero_detail_serves', true );
		$prep_time 	= recipe_hero_convert_minute_hour ( get_post_meta ( $post->ID, '_recipe_hero_detail_prep_time', true ) );
		$cook_time 	= recipe_hero_convert_minute_hour ( get_post_meta ( $post->ID, '_recipe_hero_detail_cook_time', true ) );
		$total_time = recipe_hero_convert_minute_hour ( recipe_hero_calc_total_cook_time() );
		$equipment 	= get_post_meta ( $post->ID, '_recipe_hero_detail_equipment', false ); ?>

		<div class="recipe-archive-details">

			<div class="rh-grid">

				<?php if ( $serves ) { ?>

				<div class="serves unit w-1-4">
					<strong>
						<?php if ( recipe_hero_get_option( 'rh-serves-text', 'recipe-hero-options' ) ) {
								echo recipe_hero_get_option( 'rh-serves-text', 'recipe-hero-options' );
							} else {
								_e( 'Serves', 'recipe-hero' );
							} ?>
					</strong> <span itemprop="recipeYield"><?php echo $serves; ?> <?php _e( 'People', 'recipe-hero' ); ?></span>
				</div>

				<?php } ?>

				<?php if ( $equipment ) { ?>
					<div class="equipment unit w-1-4">
						<strong>
							<?php if ( recipe_hero_get_option( 'rh-equipment-text', 'recipe-hero-options' ) ) {
									echo recipe_hero_get_option( 'rh-equipment-text', 'recipe-hero-options' );
								} else {
									_e( 'Equipment', 'recipe-hero' );
								} ?>
						</strong>
						<?php
						foreach ($equipment as $equipment_item ) {
							foreach($equipment_item as $item) {
							    echo '<div class="equipment-item">';
							    echo $item;
							    echo '</div>';
							}
						}
						?>
					</div>
				<?php } ?>

				<?php if ( $prep_time ) { ?>
					<div class="prep-time unit w-1-4">
						<strong>
							<?php if ( recipe_hero_get_option( 'rh-prep-text', 'recipe-hero-options' ) ) {
									echo recipe_hero_get_option( 'rh-prep-text', 'recipe-hero-options' );
								} else {
									_e( 'Prep Time', 'recipe-hero' );
								} ?>
						</strong> <meta itemprop="prepTime" content="<?php echo recipe_hero_schema_prep_time(); ?>">
						<div class="the-time"><span class="dashicons dashicons-clock"></span> <?php echo $prep_time; ?></div>
					</div>
				<?php } ?>

				<?php if ( $cook_time ) { ?>

					<div class="cook-time unit w-1-4">
						<strong>
							<?php if ( recipe_hero_get_option( 'rh-cook-text', 'recipe-hero-options' ) ) {
									echo recipe_hero_get_option( 'rh-cook-text', 'recipe-hero-options' );
								} else {
									_e( 'Cook Time', 'recipe-hero' );
								} ?>
						</strong> <meta itemprop="cookTime" content="<?php echo recipe_hero_schema_cook_time(); ?>">
						<div class="the-time"><span class="dashicons dashicons-clock"></span> <?php echo $cook_time; ?></div>
					</div>

				<?php } ?>

				<?php /* if ( $total_time ) { ?>

				<div class="total-time unit w-1-5">
					<strong>
					Total Time
					</strong>
					<meta itemprop="totalTime" content="<?php echo recipe_hero_schema_total_time(); ?>"> <?php echo $total_time; ?>
				</div>

				<?php } */ ?>

			</div>

		</div><!-- .recipe-archive-details -->

	<?php
	}

}