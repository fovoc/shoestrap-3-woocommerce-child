<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;

if ( !$product->is_purchasable() ) :
	return;
endif;

$availability = $product->get_availability();

if ($availability['availability']) :
	echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
endif;

if ( $product->is_in_stock() ) : ?>
	<?php do_action('woocommerce_before_add_to_cart_form'); ?>
	<hr>

	<div class="row">
		<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart form" method="post" enctype='multipart/form-data'>
			<?php do_action('woocommerce_before_add_to_cart_button'); ?>

			<div class="col-sm-4">
				<?php
					if ( ! $product->is_sold_individually() ) :
						woocommerce_quantity_input( array(
							'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
							'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
						) );
					endif;
				?>
			</div>

			<div class="col-sm-8">
				<button type="submit" class="btn btn-block btn-primary btn-lg"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button>
			</div>
			<?php do_action('woocommerce_after_add_to_cart_button'); ?>
		</form>
	</div>
	<hr>
	<?php
	do_action('woocommerce_after_add_to_cart_form');
endif;