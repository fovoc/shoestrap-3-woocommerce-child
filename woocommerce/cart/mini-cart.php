<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $ss_framework;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					?>
					<?php echo $ss_framework->open_row( 'li', null, null, null ); ?>
						<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 4 ), null, null, null ); ?>
							<a href="<?php echo get_permalink( $product_id ); ?>">
								<?php echo $thumbnail; ?>
							</a>
						<?php echo $ss_framework->close_col( 'div' ); ?>
						<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 8 ), null, null, null ); ?>
							<a href="<?php echo get_permalink( $product_id ); ?>">
								<?php echo $product_name; ?>
							</a>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<p class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</p>', $cart_item, $cart_item_key ); ?>
						<?php echo $ss_framework->close_col( 'div' ); ?>

						<?php echo WC()->cart->get_item_data( $cart_item ); ?>

					<?php echo $ss_framework->close_row( 'li' ); ?>
					<?php
				}
			}
		?>

	<?php else : ?>

		<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

	<p class="total text-center"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons text-center">
		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="<?php echo $ss_framework->button_classes( 'info', 'medium', null, 'wc-forward' ); ?>"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
		<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="<?php echo $ss_framework->button_classes( 'primary', 'medium', null, 'checkout wc-forward' ); ?>"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
	</p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>