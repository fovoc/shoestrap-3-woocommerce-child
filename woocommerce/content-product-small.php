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
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

?>
<div class="product col-sm-3 <?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo 'last';
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
		echo 'first';
	?>">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); global $product, $post, $woocommerce; ?>

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
				} else { echo '<img src="//placehold.it/500x500" alt=""></a>'; } ?>
				
				<div class="mask">
					<h2><?php echo $product->get_price_html(); ?></h2>
					<?php if (function_exists('smart_excerpt')) smart_excerpt(apply_filters( 'woocommerce_short_description', $post->post_excerpt ), 15); ?>
                    <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
                    	<a href="<?php the_permalink(); ?>" class="btn btn-sm custom"><?php _e('View', 'woocommerce'); ?></a> 
                    	<button type="submit" class="single_add_to_cart_button btn btn-sm custom"><?php echo apply_filters('single_add_to_cart_text', __('Buy', 'woocommerce'), $product->product_type); ?></button>
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

</div>