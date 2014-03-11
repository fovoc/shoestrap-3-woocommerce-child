<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $ss_framework;
?>

<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order form-inline">

	<p><?php _e( 'To track your order please enter your Order ID in the box below and press return. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>

	<?php echo $ss_framework->open_col( 'div', array( 'tablet' => 4 ), null, 'clearfix well offset4', null ); ?>
		<p class="form-row form-row-first"><label for="orderid"><?php _e( 'Order ID', 'woocommerce' ); ?></label> <br><input class="input-text <?php echo $ss_framework->form_input_classes(); ?>" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" /></p>
		<p class="form-row form-row-last"><label for="order_email"><?php _e( 'Billing Email', 'woocommerce' ); ?></label> <br><input class="input-text <?php echo $ss_framework->form_input_classes(); ?>" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during checkout.', 'woocommerce' ); ?>" /></p>
		<p class="form-row"><input type="submit" class="<?php echo $ss_framework->button_classes( 'default', 'medium', null, 'theme'); ?>" name="track" value="<?php _e( 'Track', 'woocommerce' ); ?>" /></p>
	<?php echo $ss_framework->close_col( 'div' ); ?>
	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

</form>