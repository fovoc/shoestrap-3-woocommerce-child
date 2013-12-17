<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action( 'woocommerce_before_single_product' ); ?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-sm-5" style="position:relative">
			<?php do_action( 'woocommerce_before_single_product_summary' ); ?>	
		</div>

		<div class="col-sm-7">
			<div class="details wrap">
				<?php do_action( 'woocommerce_single_product_summary' ); ?>
			</div>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>