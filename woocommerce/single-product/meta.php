<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
do_action( 'woocommerce_product_meta_start' ); ?>

<div class="product_meta">
	<small>
		<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
			<span itemprop="productID" class="sku_wrapper"><?php _e( '<i class="el-icon-chevron-right"></i> SKU ', 'woocommerce' ); ?> <span class="sku"><?php echo $product->get_sku(); ?></span>.</span><br>
		<?php endif; ?>

		<?php $size = sizeof( get_the_terms( $post->ID, 'product_cat' ) ); echo $product->get_categories( ', ', '<span class="posted_in">' . _n( '<i class="el-icon-chevron-right"></i>  CATEGORY ', '<i class="el-icon-chevron-right"></i> CATEGORIES ', $size, 'woocommerce' ) . ' ', '</span>' ); ?>
		<br>
		<?php $size = sizeof( get_the_terms( $post->ID, 'product_tag' ) ); echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( '<i class="el-icon-chevron-right"></i>  TAG ', '<i class="el-icon-chevron-right"></i> TAGS ', $size, 'woocommerce' ) . ' ', '</span>' ); ?>
	</small>
</div>
<?php do_action( 'woocommerce_product_meta_end' );