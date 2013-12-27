<?php

// Add support for WooCommerce
add_theme_support( 'woocommerce' );

// Remove default stylesheets for WooCommerce 2.1 and above
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Prioritize loading of some necessary core modules
if ( file_exists( get_template_directory() . '/lib/modules/core.redux/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core.redux/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/core/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/core.layout/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core.layout/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/core.images/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core.images/module.php';

require_once locate_template( 'lib/admin-options.php' );
require_once locate_template( 'lib/slider.php' );
require_once locate_template( 'lib/wp-core-functions.php' );
require_once locate_template( 'lib/product-classes.php' );
require_once locate_template( 'lib/product-ratings.php' );
require_once locate_template( 'lib/product-thumbnails.php' );


// Remove default WooCommerce titles
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );


add_filter( 'shoestrap_compiler', 'shoestrap_woocommerce_styles' );
function shoestrap_woocommerce_styles( $bootstrap ) {
	return $bootstrap . '
	@import "' . get_stylesheet_directory() . '/assets/less/woocommerce.less";';
}


add_filter( 'shoestrap_compiler_output', 'shoestrap_woo_hijack_compiler' );
function shoestrap_woo_hijack_compiler( $css ) {
	$css = str_replace( '/assets/less/woocommerce.less', '/assets/', $css );
	return $css;
}