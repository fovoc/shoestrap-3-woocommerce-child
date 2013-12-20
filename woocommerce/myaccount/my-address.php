<?php
/**
 * My Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$customer_id = get_current_user_id();

if ( get_option('woocommerce_ship_to_billing_address_only') == 'no' ) {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( '<i class="el-icon-home"></i> MY ADDRESSES', 'woocommerce' ) );
	$get_addresses    = array(
		'billing' => __( 'Billing Address', 'woocommerce' ),
		'shipping' => __( 'Shipping Address', 'woocommerce' )
	);
} else {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( '<i class="el-icon-home"></i> MY ADDRESS', 'woocommerce' ) );
	$get_addresses    = array(
		'billing' =>  __( 'Billing Address', 'woocommerce' )
	);
}

$col = 1;
?>

<h5><?php echo $page_title; ?></h5>

<p class="myaccount_address">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); ?>
</p>
<hr>
<div class="row ">
<?php if ( get_option('woocommerce_ship_to_billing_address_only') == 'no' ) echo '<div class="addresses">'; ?>

<?php foreach ( $get_addresses as $name => $title ) : ?>

	<div class="col-<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?> address col-sm-6">
		<header class="title">
			<h5><?php echo $title; ?></h5>
			<a href="<?php echo esc_url( add_query_arg('address', $name, get_permalink(woocommerce_get_page_id( 'edit_address' ) ) ) ); ?>" class="edit"><i class="el-icon-pencil"></i> <?php _e( 'Edit', 'woocommerce' ); ?></a>
		</header>
		<address class="well">
			<?php
				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
					'first_name' 	=> get_user_meta( $customer_id, $name . '_first_name', true ),
					'last_name'		=> get_user_meta( $customer_id, $name . '_last_name', true ),
					'company'		=> get_user_meta( $customer_id, $name . '_company', true ),
					'address_1'		=> get_user_meta( $customer_id, $name . '_address_1', true ),
					'address_2'		=> get_user_meta( $customer_id, $name . '_address_2', true ),
					'city'			=> get_user_meta( $customer_id, $name . '_city', true ),
					'state'			=> get_user_meta( $customer_id, $name . '_state', true ),
					'postcode'		=> get_user_meta( $customer_id, $name . '_postcode', true ),
					'country'		=> get_user_meta( $customer_id, $name . '_country', true )
				), $customer_id, $name );

				$formatted_address = $woocommerce->countries->get_formatted_address( $address );

				if ( ! $formatted_address )
					_e( 'You have not set up this type of address yet.', 'woocommerce' );
				else
					echo $formatted_address;
			?>
		</address>
	</div>

<?php endforeach; ?>

<?php if ( get_option('woocommerce_ship_to_billing_address_only') == 'no' ) echo '</div>'; ?>
</div>