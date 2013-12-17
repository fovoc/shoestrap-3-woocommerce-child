<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
	<section class="product">

	<div class="row">
		<header class="col-xs-12 prime">
			<h3><?php woocommerce_page_title(); ?></h3>
		</header>
	</div>

	<div class="row">

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php do_action('woocommerce_before_shop_loop'); ?>
				
				<!-- Subcat -->
				<div class="row subnav">
					<?php woocommerce_product_subcategories(); ?>
				</div>

				<!-- Loop start -->

				<?php woocommerce_product_loop_start(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php woocommerce_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php do_action('woocommerce_after_shop_loop'); ?>

			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif; ?>
		</div>

		<?php if ($sidebar == 2) { ?>
			<!-- Sidebar -->
			<div class="col-sm-4">
				<div class="sidebar">
				<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ) : ?>
					
					<aside id="archives" class="widget">
						<h5>No widget in 'Shop Sidebar' panel</h5>
						Add some <a href="<?php bloginfo( 'url' ); ?>/wp-admin/widgets.php">here</a>
					</aside>

				<?php endif; // end sidebar widget area ?>	
				</div>
			</div>
		<?php } ?>

	</div>

	</section>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

<?php get_footer('shop'); ?>