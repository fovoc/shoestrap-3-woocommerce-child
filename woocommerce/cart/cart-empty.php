<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $ss_framework;

wc_print_notices();

?>

<?php echo $ss_framework->alert( 'warning', __( 'Your cart is currently empty.', 'woocommerce' ), null, 'cart-empty', true ); ?>

<?php do_action('woocommerce_cart_is_empty'); ?>

<p class="return-to-shop">
	<a class="<?php echo $ss_framework->button_classes( 'primary', 'block', null, 'wc-backward' ); ?>" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Return To Shop', 'woocommerce' ) ?></a>
</p>