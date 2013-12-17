<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



do_action('woocommerce_before_main_content');

while ( have_posts() ) : the_post();
	woocommerce_get_template_part( 'content', 'single-product' );
endwhile;

do_action('woocommerce_after_main_content');