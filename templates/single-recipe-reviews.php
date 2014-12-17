<?php
/**
 * Recipe Single Reviews
 *
 * @package   	Recipe Hero
 * @author    	Captain Theme <info@captaintheme.com>
 * @version 	1.0.2
 */

$recipe = new RH_Recipe( get_the_ID() );

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	<div id="comments" class="comments-area">
		<h2><?php
			if ( get_option( 'recipe_hero_enable_review_rating' ) === 'yes' && ( $count = $recipe->get_rating_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'recipe-hero' ), $count, get_the_title() );
			else
				_e( 'Reviews', 'recipe-hero' );
		?></h2>

		<?php // Use get_comments_number() to check as comments_template hasn't loaded yet
		if ( '0' !== get_comments_number() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'recipe_hero_recipe_review_list_args', array( 'callback' => 'recipe_hero_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="recipe-hero-pagination">';
				paginate_comments_links( apply_filters( 'recipe_hero_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="recipe-hero-noreviews"><?php _e( 'There are no reviews yet.', 'recipe-hero' ); ?></p>

		<?php endif; ?>
	</div>

	<div id="review_form_wrapper" class="comments-area">
		<div id="review_form">
			<?php
				$commenter = wp_get_current_commenter();

				$comment_form = array(
					'title_reply'          => have_comments() ? __( 'Add a review', 'recipe-hero' ) : __( 'Be the first to review', 'recipe-hero' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
					'title_reply_to'       => __( 'Leave a Reply to %s', 'recipe-hero' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'recipe-hero' ) . ' <span class="required">*</span></label> ' .
						            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
						'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'recipe-hero' ) . ' <span class="required">*</span></label> ' .
						            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
					),
					'label_submit'  => __( 'Submit', 'recipe-hero' ),
					'logged_in_as'  => '',
					'comment_field' => ''
				);

				if ( get_option( 'recipe_hero_enable_review_rating' ) === 'yes' ) {
					$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', 'recipe-hero' ) .'</label><select name="rating" id="rating">
						<option value="">' . __( 'Rate&hellip;', 'recipe-hero' ) . '</option>
						<option value="5">' . __( 'Perfect', 'recipe-hero' ) . '</option>
						<option value="4">' . __( 'Good', 'recipe-hero' ) . '</option>
						<option value="3">' . __( 'Average', 'recipe-hero' ) . '</option>
						<option value="2">' . __( 'Not that bad', 'recipe-hero' ) . '</option>
						<option value="1">' . __( 'Very Poor', 'recipe-hero' ) . '</option>
					</select></p>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'recipe-hero' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

				comment_form( apply_filters( 'recipe_hero_recipe_review_comment_form_args', $comment_form ) );
			?>
		</div>
	</div>

	<div class="clear"></div>
</div>
