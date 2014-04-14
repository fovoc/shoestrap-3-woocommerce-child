<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post, $ss_framework;
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php if ( ! empty( $available_variations ) ) : ?>
		<hr>
		<div class="variations">
			<?php echo $ss_framework->open_row( 'div', null, null, null ); ?>
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
					<div class="variations-form-label <?php echo $ss_framework->column_classes( array( 'tablet' => 4 ), null ); ?>"><?php echo wc_attribute_label( $name ); ?></div>
					<div class="variations-form-value <?php echo $ss_framework->column_classes( array( 'mobile' => 10, 'tablet' => 7 ), null ); ?>">
						<select class="<?php echo $ss_framework->form_input_classes(); ?> pull-left" id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>">
							<option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option>
							<?php
								if ( is_array( $options ) ) {

									if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
										$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
									} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
										$selected_value = $selected_attributes[ sanitize_title( $name ) ];
									} else {
										$selected_value = '';
									}

									// Get terms if this is a taxonomy - ordered
									if ( taxonomy_exists( $name ) ) {

										$orderby = wc_attribute_orderby( $name );

										switch ( $orderby ) {
											case 'name' :
												$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
											break;
											case 'id' :
												$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false, 'hide_empty' => false );
											break;
											case 'menu_order' :
												$args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
											break;
										}

										$terms = get_terms( $name, $args );

										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) )
												continue;

											echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
										}
									} else {

										foreach ( $options as $option ) {
											echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
										}

									}
								}
							?>
						</select>
					</div> <?php
							if ( sizeof($attributes) == $loop )
								echo '<div class="'. $ss_framework->column_classes( array( 'mobile' => 2, 'tablet' => 1 ), null ) .'"><a class="reset_variations pull-right" href="#reset"><span class="sr-only">' . __( 'Clear selection', 'woocommerce' ) . '</span><button class="' . $ss_framework->button_classes( 'danger', 'medium', null, null ) .'"><i class="el-icon-remove"></i></button></a></div>';
						?>
		        <?php endforeach;?>
			<?php echo $ss_framework->close_row( 'div' ); ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<hr>

		<?php echo $ss_framework->open_row( 'div', null, 'single_variation_wrap', 'style="display:none;"' ); ?>
			<?php do_action( 'woocommerce_before_single_variation' ); ?>

			<div class="single_variation <?php echo $ss_framework->column_classes( array( 'tablet' => 4 ), null ); ?>"></div>

			<div class="variations_button <?php echo $ss_framework->column_classes( array( 'tablet' => 4 ), null ); ?>">
				<?php woocommerce_quantity_input(); ?>
			</div>
			<button type="submit" class="<?php echo $ss_framework->button_classes( 'primary', 'large', null, 'single_add_to_cart_button'); echo $ss_framework->column_classes( array( 'tablet' => 4 ), null ); ?>"><?php echo $product->single_add_to_cart_text(); ?></button>

			<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation_id" value="" />

			<?php do_action( 'woocommerce_after_single_variation' ); ?>
		<?php echo $ss_framework->close_row( 'div' ); ?>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	</div>
	<?php else : ?>

		<?php echo $ss_framework->alert( 'danger', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ), null, 'stock out-of-stock', true ); ?> ?>

	<?php endif; ?>

</form>
<hr>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
