<?php

define('WOOCOMMERCE_USE_CSS', false);
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
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
/*		float: left;
*/		margin-right: .5em;
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