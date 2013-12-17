<?php

global $woocommerce, $product;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( comments_open() ) : ?>
	<div id="reviews">
		<div id="comments">
			<?php
				if ( get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) :
					$count = $product->get_rating_count();

					if ( $count > 0 ) :
						$average = $product->get_average_rating();
						echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
						echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
						echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';
						echo '</div>';
					else :
						echo '<h5>'.__( 'Reviews', 'woocommerce' ).'</h5>';
					endif;

				else :
					echo '<h5>'.__( 'Reviews', 'woocommerce' ).'</h5>';
				endif;

				$title_reply = '';

				if ( have_comments() ) : ?>
					<ol class="commentlist">
						<?php wp_list_comments( array( 'callback' => 'woocommerce_comments' ) ); ?>
					</ol>

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
						<div class="navigation">
							<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'woocommerce' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'woocommerce' ) ); ?></div>
						</div>
					<?php endif; ?>

					<p class="add_review"><a href="#review_form" class="inline show_review_form btn btn-default btn-block btn-sm btn-link" title="<?php _e( 'Add Your Review', 'woocommerce' ); ?>"><?php _e( 'Add Review', 'woocommerce' ); ?></a></p>
					<?php $title_reply = __( 'Add a review', 'woocommerce' );

				else :
					$title_reply = __( 'Be the first to review', 'woocommerce' ).' &ldquo;'.$post->post_title.'&rdquo;'; ?>

					<p class="noreviews"><?php _e( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'woocommerce' ); ?></p>

				<?php endif;

				$commenter = wp_get_current_commenter(); ?>

			</div>
			<div id="review_form_wrapper">
				<div id="review_form">
					<?php
						$comment_form = array(
							'title_reply' => $title_reply,
							'comment_notes_before' => '',
							'comment_notes_after'  => '',
							'fields'        => array(
								'author'    => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
								'email'     => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
							),
							'label_submit'  => __( 'Submit Review', 'woocommerce' ),
							'logged_in_as'  => '',
							'comment_field' => ''
						);

						if ( get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) :
							$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'woocommerce' ) .'</label><select name="rating" id="rating"><option value="">'.__( 'Rate&hellip;', 'woocommerce' ).'</option><option value="5">'.__( 'Perfect', 'woocommerce' ).'</option><option value="4">'.__( 'Good', 'woocommerce' ).'</option><option value="3">'.__( 'Average', 'woocommerce' ).'</option><option value="2">'.__( 'Not that bad', 'woocommerce' ).'</option><option value="1">'.__( 'Very Poor', 'woocommerce' ).'</option></select></p>';
						endif;

						$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);
						comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					?>
				</div>
			</div>

		</div>
<?php endif;