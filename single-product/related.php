<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related();

if ( sizeof( $related ) == 0 ) :
	return;
endif;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'             => 'product',
	'ignore_sticky_posts'   => 1,
	'no_found_rows'         => 1,
	'posts_per_page'        => $posts_per_page,
	'orderby'               => $orderby,
	'post__in'              => $related,
	'post__not_in'          => array($product->id)
) );

$products = new WP_Query( $args );
$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>
	<div class="related products">
		<h5><?php _e('RELATED PRODUCTS', 'woocommerce'); ?></h5>
		<div class="products">
			<?php
				woocommerce_product_loop_start();
				while ( $products->have_posts() ) : $products->the_post();
					woocommerce_get_template_part( 'content', 'product-small' );
				endwhile;
				woocommerce_product_loop_end();
			?>
		</div>
	</div>
	<?php
endif;
wp_reset_postdata();