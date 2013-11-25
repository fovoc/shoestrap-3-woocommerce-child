<?php

// Remove default WooCommerce titles
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
