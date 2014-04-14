<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $ss_framework;

wc_print_notices(); 

$content_user = __( 'Hello <strong>'.$current_user->display_name.'</strong> (not '.$current_user->display_name.'? <a href="'.wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ).'">Sign out</a>).', 'woocommerce' );
$content_info = __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="'.wc_customer_edit_account_url().'">edit your password and account details</a>.', 'woocommerce' );
	
echo $ss_framework->open_row( 'div', null, 'myaccount_user', null ); 
	echo $ss_framework->open_col( 'div', array( 'mobile' => 12 ), null, null, null );
		echo $ss_framework->alert( 'info', '<p>'.$content_user.'</p><p>'.$content_info.'</p>', null, null, false );
	echo $ss_framework->close_col( 'div' );	
echo $ss_framework->close_row( 'div' ); 

?>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>
