<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $ss_framework;

if ( ! WC()->cart->coupons_enabled() )
	return;

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>';
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon" method="post" style="display:none">

	<?php echo $ss_framework->open_col( 'p', array( 'mobile' => 6 ), null, 'form-row form-row-first' ); ?>
		<input type="text" name="coupon_code" class="<?php echo $ss_framework->form_input_classes(); ?> input-text" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
	<?php echo $ss_framework->close_col( 'p' ); ?>

	<?php echo $ss_framework->open_col( 'p', array( 'mobile' => 6 ), null, 'form-row form-row-last' ); ?>
		<input type="submit" class="<?php echo $ss_framework->button_classes( 'success', 'block', null, null ); ?>" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />
	<?php echo $ss_framework->close_col( 'p' ); ?>

	<?php echo $ss_framework->clearfix(); ?>
</form>