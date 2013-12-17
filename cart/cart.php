<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();
?>

<section class="cartpage">
<?php $woocommerce->show_messages(); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post" class="form-inline">
<?php do_action( 'woocommerce_before_cart_table' ); ?>
<table class="shop_table cart table" cellspacing="0">
	<thead>
		<tr>
			<th class="product-name"><?php _e('Product', 'woocommerce'); ?></th>
			<th class="product-price"><?php _e('Price', 'woocommerce'); ?></th>
			<th class="product-quantity"><?php _e('Quantity', 'woocommerce'); ?></th>
			<th class="product-subtotal"><?php _e('Total', 'woocommerce'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">

						<!-- Product Name -->
						<td class="product-name">
							
							<div class="row">
								<div class="col-sm-4 hidden-xs cart-img">
									<?php
										$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );
										printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
									?>
								</div>
								<div class="col-xs-3 col-sm-1">
									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><i class="fa fa-minus-circle"></i></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key ); ?>
								</div>
								<div class="col-xs-9 col-sm-7 item">
									<?php
										if ( ! $_product->is_visible() || ( $_product instanceof WC_Product_Variation && ! $_product->parent_is_visible() ) )
											echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
										else
											printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

										// Meta data
										echo '<small>'.$woocommerce->cart->get_item_data( $values ).'</small>';

		                   				// Backorder notification
		                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
		                   					echo '<p class="backorder_notification">' . __('Available on backorder', 'woocommerce') . '</p>';
									?>
								</div>
							</div>
							
						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								$product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = '1';
								} else {
									$data_min = apply_filters( 'woocommerce_cart_item_data_min', '', $_product );
									$data_max = ( $_product->backorders_allowed() ) ? '' : $_product->get_stock_quantity();
									$data_max = apply_filters( 'woocommerce_cart_item_data_max', $data_max, $_product );

									$product_quantity = sprintf( '<div class="quantity"><input name="cart[%s][qty]" data-min="%s" data-max="%s" value="%s" title="Qty" class="text-center input-text qty text form-control input-sm" maxlength="12" /></div>', $cart_item_key, $data_min, $data_max, esc_attr( $values['quantity'] ) );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

				<div class="row checkout-row">
					
					<?php if ( $woocommerce->cart->coupons_enabled() ) { ?>
					<div class="coupon col-sm-6 form-inline">

						<!-- <label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> --> 
						<div class="row">
							<div class="col-xs-7"><input name="coupon_code" type="text" class="input-text input-sm form-control" id="coupon_code" value="" /></div>
							<div class="col-xs-5"><input type="submit" class="button btn btn-default btn-sm" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" /></div>
						</div>
						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
					<hr class="visible-xs">
					<?php } ?>
					

					<div class="col-sm-6 proceed <?php if ( $woocommerce->cart->coupons_enabled() ) { ?>text-right<?php } ?>">
						<input type="submit" class="button btn btn-sm btn-default" name="update_cart" value="<?php _e('Update Cart', 'woocommerce'); ?>"/>
						<input type="submit" class="checkout-button button alt btn btn-sm theme" name="proceed" value="<?php _e('Proceed to Checkout &rarr;', 'woocommerce'); ?>"/>

						<?php do_action('woocommerce_proceed_to_checkout'); ?>

						<?php $woocommerce->nonce_field('cart') ?>	
					</div>

				</div>
				<hr class="hidden-xs">
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>
<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>
<div class="cart-collaterals">

	<div class="row ">
		<div class="col-sm-6">
			<?php woocommerce_cart_totals(); ?>
		</div>
		<div class="col-sm-6">
			<?php woocommerce_shipping_calculator(); ?>
		</div>
	</div>

	<hr>
	<?php do_action('woocommerce_cart_collaterals'); ?>

</div>
</section>