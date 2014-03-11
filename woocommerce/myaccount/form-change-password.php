<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $ss_framework;
?>

<?php wc_print_notices(); ?>

<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 4 ), null, 'col-sm-offset-4', null ); ?>
<form action="<?php echo esc_url( get_permalink( wc_get_page_id( 'change_password' ) ) ); ?>" method="post" class="form">

	<p class="form-group">
		<label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label><br>
		<input type="password" class="<?php echo $ss_framework->form_input_classes(); ?>" name="password_1" id="password_1" />
	</p>
	<p class="form-group">
		<label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label><br>
		<input type="password" class="<?php echo $ss_framework->form_input_classes(); ?>" name="password_2" id="password_2" />
	</p>
	<div class="clear"></div>

	<p><input type="submit" class="<?php echo $ss_framework->button_classes( 'primary', 'block', null, null ); ?>" name="change_password" value="<?php _e( 'Save', 'woocommerce' ); ?>" /></p>

	<?php wp_nonce_field( 'woocommerce-change_password' ); ?>
	<input type="hidden" name="action" value="change_password" />

</form>
<?php echo $ss_framework->close_col( 'div' ); ?>