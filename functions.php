<?php

require_once locate_template('/lib/admin-options.php');

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
	img.avatar.media-object {
		border-radius: 50%;
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


function shoestrap_get_rating_html( $rating = null ) {
	global $product;

	if ( ! is_numeric( $rating ) ) {
		$rating = $product->get_average_rating();
		$rating = round( $rating );
	}

	if ( $rating > 0 ) {
		$star_on  = '<i class="el-icon-star text-success"></i>';
		$star_off = '<i class="el-icon-star-empty text-danger"></i>';

		$stars .= $star_on;
		if ( $rating >= 2 ) :
			$stars .= $star_on;
			if ( $rating >= 3 ) :
				$stars .= $star_on;
				if ( $rating >= 4 ) :
					$stars .= $star_on;
					if ( $rating >= 5 ) :
						$stars .= $star_on;
					else :
						$stars .= $star_off;
					endif;
				else :
					$stars .= $star_off . $star_off;
				endif;
			else :
				$stars .= $star_off . $star_off . $star_off;
			endif;
		else :
			$stars .= $star_off . $star_off . $star_off . $star_off;
		endif;

		$rating_html  = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating ) . '">' . $stars . '</div>';

		return $rating_html;
	}
}

/*
 * Add classes to single posts
 */
add_filter( 'post_class', 'shoestrap_woo_post_classes' );
if ( !function_exists( 'shoestrap_woo_post_classes' ) ) :
function shoestrap_woo_post_classes( $classes ) {
	global $post;
	// get the specified width ( narrow/normal/wide )
	$mode = shoestrap_getVariable( 'shoestrap_woo_posts_columns', 'normal' );
	
	// Remove unnecessary classes
	foreach (range(0, 12) as $number) :
		$remove_classes[] = 'col-xs-'.$number.'';
		$remove_classes[] = 'col-sm-'.$number.'';
		$remove_classes[] = 'col-md-'.$number.'';
		$remove_classes[] = 'col-lg-'.$number.'';
	endforeach;

	$classes = array_diff( $classes, $remove_classes );

	$classes[] = '';
	// calculate the css classes based on the above selection
	if ( $mode == 'narrow' ) :
		$classes[] = 'col-lg-3';
		$classes[] = 'col-md-4';
		$classes[] = 'col-sm-6';
		$classes[] = 'col-xs-12';
	elseif ( $mode == 'normal' ) :
		$classes[] = 'col-lg-4';
		$classes[] = 'col-md-6';
		$classes[] = 'col-sm-6';
		$classes[] = 'col-xs-12';
	else :
		$classes[] = 'col-lg-6';
		$classes[] = 'col-md-6';
		$classes[] = 'col-sm-12';
		$classes[] = 'col-xs-12';
	endif;

	// If this is NOT a singular post/page etc, return the classes
	if ( !is_singular() ) :
		return $classes;
	endif;
}
endif;
