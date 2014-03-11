<?php
/**
 * Edit address form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $current_user, $ss_framework;

$page_title = ( $load_address == 'billing' ) ? __( 'Billing Address', 'woocommerce' ) : __( 'Shipping Address', 'woocommerce' );

get_currentuserinfo();
?>

<?php wc_print_notices(); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>

	<form method="post" class="form" id="customer_details">

		<h4><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h4>

		<?php foreach ( $address as $key => $field ) : ?>

			<?php $custom = array(
			'class'       => array( 'form-group' ),
			'label_class' => array( 'control-label' ),
			'input_class' => array( $ss_framework->form_input_classes() ),
		);
		$args = wp_parse_args( $custom, $field  );
		?>
		<?php woocommerce_form_field( $key, $args, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

		<?php endforeach; ?>

		<p>
			<input type="submit" class="<?php echo $ss_framework->button_classes( 'primary', 'block', null, null ); ?>" name="save_address" value="<?php _e( 'Save Address', 'woocommerce' ); ?>" />
			<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
			<input type="hidden" name="action" value="edit_address" />
		</p>

	</form>

<?php endif; ?>