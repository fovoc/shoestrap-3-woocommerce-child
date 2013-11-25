<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

do_action( 'woocommerce_before_single_product' ); ?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ($product->is_on_sale()) :
		echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</span>', $post, $product);
	endif; ?>

	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
	<div class="summary entry-summary">
		<?php do_action( 'woocommerce_single_product_summary' ); ?>
	</div><!-- .summary -->
	<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</div><!-- #product-<?php the_ID(); ?> -->
<?php do_action( 'woocommerce_after_single_product' );