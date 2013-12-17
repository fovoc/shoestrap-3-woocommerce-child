<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibilty
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;
?>
<article class="product col-sm-4 <?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo 'last';
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
		echo 'first';
	?>">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); global $product, $post, $woocommerce, $loop; ?>

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			//do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

	  		<div class="view view-thumb">
	  			<?php if ($product->is_on_sale()) : ?>
					<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__('SALE', 'woocommerce').'</span>', $post, $product); ?>
				<?php endif; ?>
				<?php if(has_post_thumbnail()) {
					the_post_thumbnail('medium');
				} else { echo '<img src="//placehold.it/500x500" alt="" class="img-responsive"></a>'; } ?>
				
				<div class="mask">
					<h2><?php echo $product->get_price_html(); ?></h2>
					<?php if (function_exists('smart_excerpt')) smart_excerpt(apply_filters( 'woocommerce_short_description', $post->post_excerpt ), 80); ?>
                    <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
                    	<a href="<?php the_permalink(); ?>" class="btn btn-sm custom"><?php _e('View', 'woocommerce'); ?></a> 
                    	<?php global $product;

						if ( ! $product->is_purchasable() && ! in_array( $product->product_type, array( 'external', 'grouped' ) ) ) return;
						?>

						<?php if ( ! $product->is_in_stock() ) : ?>

							<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="btn btn-sm custom"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ); ?></a>

						<?php else : ?>

							<?php

								switch ( $product->product_type ) {
									case "variable" :
										$link 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
										$label 	= apply_filters( 'variable_add_to_cart_text', __('Select', 'woocommerce') );
									break;
									case "grouped" :
										$link 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
										$label 	= apply_filters( 'grouped_add_to_cart_text', __('Options', 'woocommerce') );
									break;
									case "external" :
										$link 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
										$label 	= apply_filters( 'external_add_to_cart_text', __('Read More', 'woocommerce') );
									break;
									default :
										$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
										$label 	= apply_filters( 'add_to_cart_text', __('Buy', 'woocommerce') );
									break;
								}

								if ( $product->product_type == 'simple' ) {
									
									?>
									<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart form" method="post" enctype='multipart/form-data'>
								
									 	<?php //woocommerce_quantity_input(); ?>
								
									 	<button type="submit" class="btn btn-sm alt custom"><?php echo $label; ?></button>
								
									</form>
									<?php
									
								} else {
									
									printf('<a href="%s" rel="nofollow" data-product_id="%s" class="btn btn-sm add_to_cart_button product_type_%s custom">%s</a>', $link, $product->id, $product->product_type, $label);
									
								}

							?>

						<?php endif; ?>

                    </form>
				</div>
			</div>
			<p class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			//do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>

</article>