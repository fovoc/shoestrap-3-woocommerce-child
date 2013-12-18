<?php

if ( ! defined( 'ABSPATH' ) ) exit;

global $woocommerce;

$order = new WC_Order( $order_id ); ?>
<hr>
<h5><?php _e( 'Order Details', 'woocommerce' ); ?></h5>
<table class="shop_table order_details table table-bordered">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php
			if ( sizeof( $order->get_items() ) > 0 ) :
				foreach ( $order->get_items() as $item ) :
					$_product = get_product( $item['variation_id'] ? $item['variation_id'] : $item['product_id'] ); ?>
					<tr class = "<?php echo esc_attr( apply_filters( 'woocommerce_order_table_item_class', 'order_table_item', $item, $order ) ); ?>">
						<td class="product-name">
							<?php echo apply_filters( 'woocommerce_order_table_product_title', '<a href="' . get_permalink( $item['product_id'] ) . '">' . $item['name'] . '</a>', $item ); ?>
							<?php echo apply_filters( 'woocommerce_order_table_item_quantity', '<strong class="product-quantity">&times; ' . $item['qty'] . '</strong>', $item ); ?>
							<?php $item_meta = new WC_Order_Item_Meta( $item['item_meta'] ); ?>
							<?php $item_meta->display(); ?>

							<?php if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) : ?>
								<?php $download_file_urls = $order->get_downloadable_file_urls( $item['product_id'], $item['variation_id'], $item );
								$i = 0;
								$links = array();

								foreach ( $download_file_urls as $file_url => $download_file_url ) :
									$filename = woocommerce_get_filename_from_url( $file_url );
									$links[] = '<small><a href="' . $download_file_url . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_file_urls ) > 1 ? ' ' . ( $i + 1 ) . ': ' : ': ' ) ) . $filename . '</a></small>';
									$i++;
								endforeach; ?>
								<?php echo implode( '<br/>', $links ); ?>
							<?php endif; ?>
						</td>

						<td class="product-total"><?php echo $order->get_formatted_line_subtotal( $item ); ?></td>
					</tr>

					<?php if ( $order->status=='completed' || $order->status=='processing' ) : ?>
						<?php if ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) : ?>
							<tr class="product-purchase-note">
								<td colspan="3"><?php echo apply_filters( 'the_content', $purchase_note ); ?></td>
							</tr>
						<?php endif; ?>
					<?php endif;
				endforeach;
			endif;
		?>
		<?php do_action( 'woocommerce_order_items_table', $order ); ?>
	</tbody>

	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) :
				foreach ( $totals as $total ) : ?>
					<tr>
						<th scope="row"><?php echo $total['label']; ?></th>
						<td><?php echo $total['value']; ?></td>
					</tr>
					<?php
				endforeach;
			endif;
		?>
	</tfoot>

</table>

<?php if ( get_option( 'woocommerce_allow_customers_to_reorder' ) == 'yes' && $order->status == 'completed' ) : ?>
	<p class="order-again">
		<a href="<?php echo esc_url( $woocommerce->nonce_url( 'order_again', add_query_arg( 'order_again', $order->id, add_query_arg( 'order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ) ) ) ); ?>" class="button"><?php _e( 'Order Again', 'woocommerce' ); ?></a>
	</p>
<?php endif; ?>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<hr>

<header><h5><?php _e( 'Customer details', 'woocommerce' ); ?></h5></header>

<dl class="customer_details well">

	<?php if ( $order->billing_email ) : ?>
		<i class="el-icon-envelope"></i> <?php _e( 'EMAIL : ', 'woocommerce' ); ?> <?php echo $order->billing_email; ?>
		<br />
	<?php endif; ?>

	<?php if ( $order->billing_phone ) : ?>
		<i class="el-icon-envelope"></i> <?php _e( 'TELEPHONE : ', 'woocommerce' ); ?><?php echo $order->billing_phone; ?>
	<?php endif; ?>

	</dl>

	<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) == 'no' ) : ?>
		<div class="col2-set addresses row ">
			<div class="col-1 col-sm-6">
	<?php endif; ?>

	<header class="title"><h5><?php _e( 'Billing Address', 'woocommerce' ); ?></h5></header>

	<address class="well">
		<p>
			<?php if ( !$order->get_formatted_billing_address() ) : ?>
				<?php _e( 'N/A', 'woocommerce' ); ?>
			<?php else : ?>
				<?php echo $order->get_formatted_billing_address(); ?>
			<?php endif; ?>
		</p>
	</address>

	<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) == 'no' ) : ?>
		</div>
		<div class="col-2 col-sm-6">
			<header class="title"><h5><?php _e( 'Shipping Address', 'woocommerce' ); ?></h5></header>
			<address class="well">
				<p>
					<?php if ( !$order->get_formatted_shipping_address() ) : ?>
						<?php _e( 'N/A', 'woocommerce' ); ?>
					<?php else : ?>
						<?php echo $order->get_formatted_shipping_address(); ?>
					<?php endif; ?>
				</p>
			</address>
		</div>
	</div>
<?php endif;