<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>

<div class="wrap">
	<div id="slider" class="flexslider">
		<ul class="slides">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full', false, '' ); ?>
				<li><a href="<?php echo $src[0]; ?>" itemprop="image" class="woocommerce-main-image zoom" rel="largeimg" ><?php the_post_thumbnail('full'); ?></a></li>
			<?php endif;

			if ( has_post_thumbnail() ):
				$attachment_ids = $product->get_gallery_attachment_ids();

				if ( $attachment_ids ) :
					$loop = 0;
					$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

					foreach ( $attachment_ids as $attachment_id ) :
						$image_link = wp_get_attachment_url( $attachment_id );

						if ( !$image_link ) :
							continue;
						endif;

						$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
						$image_title = esc_attr( get_the_title( $attachment_id ) );

						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image zoom" rel="largeimg">%s</a></li>', $image_link, $image ), $attachment_id, $post->ID );

						$loop++;
					endforeach;

				endif;

			else :
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><img src="%s" alt="Placeholder" /></li>', woocommerce_placeholder_img_src() ), $post->ID );
			endif; ?>	
		</ul>
	</div>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>