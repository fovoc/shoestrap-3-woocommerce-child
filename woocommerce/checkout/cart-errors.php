<?php
/**
 * Cart errors page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $ss_framework;

wc_print_notices(); ?>

<?php echo $ss_framework->alert( 'warning', __( 'There are some issues with the items in your cart (shown above). Please go back to the cart page and resolve these issues before checking out.', 'woocommerce' ), null, null, true ); ?>

<?php do_action('woocommerce_cart_has_errors'); ?>

<?php echo $ss_framework->alert( 'danger', '<a class="'. echo $ss_framework->button_classes( 'danger', 'medium', null, 'wc-backward' ); .'" href="'. echo get_permalink(wc_get_page_id( 'cart' ) ); .'">'. __( 'Return To Cart', 'woocommerce' ) .'</a>' , null, null, true ); ?>
