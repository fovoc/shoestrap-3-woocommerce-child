<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$alt = 1;
$attributes = $product->get_attributes();

if ( empty( $attributes ) && ( !$product->enable_dimensions_display() || ( !$product->has_dimensions() && !$product->has_weight() ) ) ) :
	return;
endif; ?>

<table class="shop_attributes table table-bordered">
	<?php if ( $product->enable_dimensions_display() ) : ?>
		<?php if ( $product->has_weight() ) : ?>
			<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
				<th><?php _e( 'Weight', 'woocommerce' ) ?></th>
				<td class="product_weight"><?php echo $product->get_weight() . ' ' . esc_attr( get_option('woocommerce_weight_unit') ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $product->has_dimensions() ) : ?>
			<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
				<th><?php _e( 'Dimensions', 'woocommerce' ) ?></th>
				<td class="product_dimensions"><?php echo $product->get_dimensions(); ?></td>
			</tr>
		<?php endif; ?>
	<?php endif; ?>

	<?php foreach ( $attributes as $attribute ) :
		if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && !taxonomy_exists( $attribute['name'] ) ) ) :
			continue;
		endif; ?>

		<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
			<th><?php echo $woocommerce->attribute_label( $attribute['name'] ); ?></th>
			<td>
				<?php
					$values = ( $attribute['is_taxonomy'] ) ? $values = woocommerce_get_product_terms( $product->id, $attribute['name'], 'names' ) : array_map( 'trim', explode( '|', $attribute['value'] ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
				?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>