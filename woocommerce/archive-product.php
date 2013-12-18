<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action('woocommerce_before_main_content');
do_action( 'woocommerce_archive_description' );

if ( have_posts() ) :
	do_action('woocommerce_before_shop_loop'); ?>
	<div class="row subnav">
		<?php woocommerce_product_subcategories(); ?>
	</div>

	<?php
		woocommerce_product_loop_start();
		while ( have_posts() ) : the_post();
			woocommerce_get_template_part( 'content', 'product' );
		endwhile;

		woocommerce_product_loop_end();

		do_action('woocommerce_after_shop_loop');

		elseif ( !woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :
			woocommerce_get_template( 'loop/no-products-found.php' );
		endif;
endif;
do_action('woocommerce_after_main_content');