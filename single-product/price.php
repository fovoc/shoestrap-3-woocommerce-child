<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product; ?>

<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	<h4 itemprop="price" class="price"><i class="fa fa-tag"></i> <?php echo $product->get_price_html(); ?></h4>
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
</div>