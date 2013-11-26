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
		display: inline-block;
	}
	</style>
	<?php
}
add_action( 'wp_footer', 'shoestrap_woocommerce_styles' );