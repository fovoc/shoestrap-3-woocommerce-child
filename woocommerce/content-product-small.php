<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) :
	$woocommerce_loop['loop'] = 0;
endif;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) :
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
endif;

// Ensure visibility
if ( ! $product->is_visible() ) :
	return;
endif;

// Increase loop count
$woocommerce_loop['loop']++; ?>

<div class="product col-sm-3">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); global $product, $post, $woocommerce; ?>
	<div class="view view-thumb">
		<?php if ($product->is_on_sale()) : ?>
			<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__('SALE', 'woocommerce').'</span>', $post, $product); ?>
		<?php endif; ?>

		<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail('medium');
			else :
				echo '<img src="//placehold.it/500x500" alt=""></a>';
			endif;
		?>

		<div class="mask">
			<h2><?php echo $product->get_price_html(); ?></h2>
			<?php
				if ( function_exists( 'smart_excerpt' ) ) :
					smart_excerpt(apply_filters( 'woocommerce_short_description', $post->post_excerpt ), 15);
				endif;
			?>

			<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
				<a href="<?php the_permalink(); ?>" class="btn btn-sm custom"><?php _e('View', 'woocommerce'); ?></a>
				<button type="submit" class="single_add_to_cart_button btn btn-sm custom"><?php echo apply_filters('single_add_to_cart_text', __('Buy', 'woocommerce'), $product->product_type); ?></button>
			</form>
		</div>
	</div>

	<p class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
</div>