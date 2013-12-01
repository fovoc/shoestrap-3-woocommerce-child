<?php

// Remove default stylesheets for pre-2.1 versions of WooCommerce
define('WOOCOMMERCE_USE_CSS', false);
// Remove default stylesheets for WooCommerce 2.1 and above
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
// Add support for WooCommerce
add_theme_support( 'woocommerce' );

// Remove default WooCommerce titles
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

function shoestrap_woocommerce_styles() { ?>
	<style>
	div.quantity.buttons_added {
		width: 50px;
	}
	div.quantity.buttons_added .minus,
	div.quantity.buttons_added .plus {
		display: none;
	}
	div.quantity.buttons_added .qty{
		margin-right: .5em;
	}
	.woocommerce div.product div.images,
	.woocommerce-page div.product div.images,
	.woocommerce #content div.product div.images,
	.woocommerce-page #content div.product div.images {
		float: left;
		margin-right: 1em;
	}
	.woocommerce div.product form.cart div.quantity,
	.woocommerce-page div.product form.cart div.quantity,
	.woocommerce #content div.product form.cart div.quantity,
	.woocommerce-page #content div.product form.cart div.quantity {
		float: left;
	}
	.woocommerce div.product .woocommerce-tabs,
	.woocommerce-page div.product .woocommerce-tabs,
	.woocommerce #content div.product .woocommerce-tabs,
	.woocommerce-page #content div.product .woocommerce-tabs {
		clear: both;
		position: relative;
		top: 1em;
	}
	</style>
	<?php
}
add_action( 'wp_footer', 'shoestrap_woocommerce_styles' );


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'shoestrap_woocommerce_template_loop_product_thumbnail', 10 );

function shoestrap_woocommerce_template_loop_product_thumbnail() {
	echo shoestrap_woocommerce_get_product_thumbnail();
}

function shoestrap_woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
	global $post;

	$data['width']  = ( shoestrap_content_width_px() / 2 - shoestrap_getVariable( 'layout_gutter' ) );
	$data['url']    = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	$data['height'] = $data['width'];

	$image = shoestrap_image_resize( $data );
	$image = '<a href="' . get_permalink() . '"><img class="featured-image" src="' . $image['url'] . '" /></a>';

	if ( has_post_thumbnail() )
		return $image;
	elseif ( wc_placeholder_img_src() )
		return wc_placeholder_img( $size );
}