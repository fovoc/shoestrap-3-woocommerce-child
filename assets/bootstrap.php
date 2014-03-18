<?php

function ss_woo_bootstrap_css( $styles ) {
	return $styles . '
	/* =Custom Font
	-------------------------------------------------------------- */
	@font-face {
		font-family: "star";
		src:url("' . WC()->plugin_url() . '/assets/fonts/star.eot");
		src:url("' . WC()->plugin_url() . '/assets/fonts/star.eot?#iefix") format("embedded-opentype"),
			url("' . WC()->plugin_url() . '/assets/fonts/star.woff") format("woff"),
			url("' . WC()->plugin_url() . '/assets/fonts/star.ttf") format("truetype"),
			url("' . WC()->plugin_url() . '/assets/fonts/star.svg#star") format("svg");
		font-weight: normal;
		font-style: normal;
	}
	@font-face {
		font-family: "WooCommerce";
		src:url("' . WC()->plugin_url() . '/assets/fonts/WooCommerce.eot");
		src:url("' . WC()->plugin_url() . '/assets/fonts/WooCommerce.eot?#iefix") format("embedded-opentype"),
			url("' . WC()->plugin_url() . '/assets/fonts/WooCommerce.woff") format("woff"),
			url("' . WC()->plugin_url() . '/assets/fonts/WooCommerce.ttf") format("truetype"),
			url("' . WC()->plugin_url() . '/assets/fonts/WooCommerce.svg#WooCommerce") format("svg");
		font-weight: normal;
		font-style: normal;
	}
	';
}
add_filter( 'shoestrap_compiler', 'ss_woo_bootstrap_css', 1 );