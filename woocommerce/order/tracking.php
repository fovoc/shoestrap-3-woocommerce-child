<?php

if ( ! defined( 'ABSPATH' ) ) exit;

global $woocommerce;

$status             = get_term_by( 'slug', $order->status, 'shop_order_status' );
$order_status_text  = sprintf( __( 'Order %s which was made %s has the status &ldquo;%s&rdquo;', 'woocommerce' ), $order->get_order_number(), human_time_diff(strtotime($order->order_date), current_time('timestamp')) . ' ' . __( 'ago', 'woocommerce' ), __($status->name, 'woocommerce') );
$order_status_text .= ( $order->status == 'completed') ? ' ' . __( 'and was completed', 'woocommerce' ) . ' ' . human_time_diff( strtotime( $order->completed_date ), current_time( 'timestamp' ) ) . __( ' ago', 'woocommerce' ) : '';
$order_status_text .= '.';

echo wpautop( esc_attr( apply_filters( 'woocommerce_order_tracking_status', $order_status_text, $order ) ) );

$notes = $order->get_customer_order_notes();

if ( $notes ) : ?>
	<h5><?php _e( 'Order Updates', 'woocommerce' ); ?></h5>
	<ol class="commentlist notes nav">
		<?php foreach ( $notes as $note ) : ?>
			<li class="comment note">
				<div class="comment_container">
					<div class="comment-text">
						<p class="meta"><?php echo date_i18n('l jS \of F Y, h:ia', strtotime($note->comment_date)); ?></p>
						<div class="description">
							<?php echo wpautop( wptexturize( wp_kses_post( $note->comment_content ) ) ); ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
	<?php
endif;

do_action( 'woocommerce_view_order', $order->id );