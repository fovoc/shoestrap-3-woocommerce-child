<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action( 'woocommerce_before_single_product' ); ?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
	<div class="summary entry-summary">
		<?php do_action( 'woocommerce_single_product_summary' ); ?>
	</div><!-- .summary -->
	<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</div><!-- #product-<?php the_ID(); ?> -->
<?php do_action( 'woocommerce_after_single_product' );