<?php


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