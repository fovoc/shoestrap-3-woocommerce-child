<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
	return;
?>

<div class="shoptop bottom row">
	<div class="col-xs-3 text-left">
		<?php previous_posts_link( __( '<div class="btn btn-sm btn-default theme"><span class="meta-nav">&larr;</span> Prev</div>', 'woocommerce' ) ); ?>
	</div>
	<div class="col-xs-6">
		<form class="woocommerce-ordering form-inline" method="get">
		<select name="orderby" class="orderby form-control input-sm">
			<?php
				$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
					'menu_order' => __( 'Default sorting', 'woocommerce' ),
					'popularity' => __( 'Sort by popularity', 'woocommerce' ),
					'rating'     => __( 'Sort by average rating', 'woocommerce' ),
					'date'       => __( 'Sort by newness', 'woocommerce' ),
					'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
					'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
				) );
	
				if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
					unset( $catalog_orderby['rating'] );
	
				foreach ( $catalog_orderby as $id => $name )
					echo '<option value="' . esc_attr( $id ) . '" ' . selected( $catalog_orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
			?>
		</select>
		<?php
			// Keep query string vars intact
			foreach ( $_GET as $key => $val ) {
				if ( 'orderby' == $key )
					continue;
				
				if (is_array($val)) {
					foreach($val as $innerVal) {
						echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
					}
				
				} else {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
				}
			}
		?>
	</form>
	</div>
	<div class="col-sm-3 text-right">
		<?php next_posts_link( __( '<div class="btn btn-sm btn-default theme">Next <span class="meta-nav">&rarr;</span></div>', 'woocommerce' ) ); ?>
	</div>
</div>