<?php

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