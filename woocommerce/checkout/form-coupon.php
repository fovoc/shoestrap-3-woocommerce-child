<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( ! $woocommerce->cart->coupons_enabled() )
	return;

$info_message = apply_filters('woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ));
?>

<div class="well">
<p class="woocommerce-info"><?php echo $info_message; ?> <a href="#" class="showcoupon"><?php _e( 'Click here to enter your code', 'woocommerce' ); ?></a></p>

<form class="checkout_coupon form form-inline" method="post" style="display:none">
	<div class="row">
	<div class="col-sm-8"><input type="text" name="coupon_code" class="form-control input-text" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" /></div>
	<div class="col-sm-4"><input type="submit" class="btn btn-default theme" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" /></div>
	</div>
</form>
</div>