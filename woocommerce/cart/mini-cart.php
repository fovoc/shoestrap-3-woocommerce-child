<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

	<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

		<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

			$_product = $cart_item['data'];

			// Only display if allowed
			if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
				continue;

			// Get price
			$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

			$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
			?>

			<li class="row">
				<div class="col-xs-4">
					<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
						<?php echo $_product->get_image(); ?>
					</a>
				</div>
				<div class="col-xs-8">
					<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
						<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
					</a>
					<p><small><?php echo $woocommerce->cart->get_item_data( $cart_item ); ?> <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span>' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></small></p>
				</div>
			</li>

		<?php endforeach; ?>

	<?php else : ?>

		<li class="empty"><?php _e('No products in the cart.', 'woocommerce'); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

	<hr />
	<p class="total text-center"><strong><?php _e('Subtotal', 'woocommerce'); ?>:</strong> <?php echo $woocommerce->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="text-center">
		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="btn btn-sm"><?php _e('View Cart', 'woocommerce'); ?></a>
		<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="btn btn-sm theme checkout"><?php _e('Checkout <i class="el-icon-shopping-cart"></i>', 'woocommerce'); ?></a>
	</p>
	<hr />
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' );