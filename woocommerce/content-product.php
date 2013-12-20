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
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;
?>

<?php $classes = shoestrap_woo_post_extra_classes(); ?>
<div <?php post_class( $classes ); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<?php global $product, $post, $woocommerce; ?>
	<div class="thumbnail">
		<?php if ($product->is_on_sale()) : ?>
			<?php echo apply_filters('woocommerce_sale_flash', '<div class="onsale-ribbon"><div class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</div></div>', $post, $product); ?>
		<?php endif; ?>

		<?php echo shoestrap_woocommerce_get_product_thumbnail(); ?>
		<div class="caption">
			<h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<div class="clearfix"></div>

			<?php if ( function_exists( 'smart_excerpt' ) ) : ?>
				<?php smart_excerpt( apply_filters( 'woocommerce_short_description', $post->post_excerpt ), 15 ); ?>
			<?php endif; ?>

			<div class="clearfix"></div>
			<a class="btn btn-link pull-left strong" href="<?php the_permalink(); ?>"><?php echo $product->get_price_html(); ?></a>
			<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart pull-left" method="post" enctype='multipart/form-data'>
				<button type="submit" class="btn btn-primary "><?php echo apply_filters('single_add_to_cart_text', __('Buy', 'woocommerce'), $product->product_type); ?></button>
			</form>
		</div>
		<div class="clearfix"></div>
	</div>
</div>