<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( have_posts() ) : ?>
	<?php do_action('woocommerce_before_shop_loop'); ?>
	<div class="products">
		<?php woocommerce_product_loop_start(); ?>
		<?php woocommerce_product_subcategories(); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
		<?php endwhile; ?>
		<?php woocommerce_product_loop_end(); ?>
	</div>
	<?php do_action('woocommerce_after_shop_loop'); ?>
<?php else : ?>
	<?php if ( !woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
		<p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>
	<?php endif; ?>
<?php endif; ?>