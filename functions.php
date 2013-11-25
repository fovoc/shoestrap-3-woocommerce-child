<?php

// Remove default WooCommerce titles
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product_summary', 'shoestrap_woocommerce_output_product_data_tabs', 10 );

function shoestrap_woocommerce_output_product_data_tabs() {
	$tabs = apply_filters( 'woocommerce_product_tabs', array() );

	if ( ! empty( $tabs ) ) : ?>

		<div class="woocommerce-tabs">
			<ul class="nav nav-tabs">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<?php $active = $key == 'description' ? 'active' : ''; ?>
					<li class="<?php echo $key ?>_tab <?php echo $active; ?>" >
						<a href="#tab-<?php echo $key ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="tab-content">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<?php $active = $key == 'description' ? 'active' : ''; ?>
					<div class="tab-pane fade in entry-content <?php echo $active; ?>" id="tab-<?php echo $key ?>">
						<?php call_user_func( $tab['callback'], $key, $tab ) ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif;
}