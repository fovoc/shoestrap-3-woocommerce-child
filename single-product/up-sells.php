<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>
	<div class="upsells products clearfix">
		<h5><?php _e('YOU MAY ALSO LIKE&hellip;', 'woocommerce') ?></h5>
		<?php
			woocommerce_product_loop_start();
			while ( $products->have_posts() ) : $products->the_post();
				woocommerce_get_template_part( 'content', 'product-small' );
			endwhile;
			woocommerce_product_loop_end();
		?>
	</div>
	<?php
endif;
wp_reset_postdata();