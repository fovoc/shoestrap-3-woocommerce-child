<?php

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) :
	$woocommerce_loop['loop'] = 0;
endif;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) :
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
endif;

// Increase loop count
$woocommerce_loop['loop']++;
?>

<div class="col-sm-3 col-xs-6 item">
	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
		<?php do_action( 'woocommerce_before_subcategory_title', $category ); ?>

		<div class="row text-center">
			<small>
				<?php echo $category->name; ?>
				<?php if ( $category->count > 0 ) : ?>
					<span class="count label"> <?php echo $category->count; ?></span>
				<?php endif; ?>
			</small>
		</div>

		<?php do_action( 'woocommerce_after_subcategory_title', $category ); ?>
	</a>
	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</div>