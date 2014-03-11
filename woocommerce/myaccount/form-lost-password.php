<?php
/**
 * Lost password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $ss_framework;

?>

<?php wc_print_notices(); ?>

<form method="post" class="lost_reset_password form">

	<?php if( 'lost_password' == $args['form'] ) : ?>

        <p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>

        <p class="form-row form-row-first"><label for="user_login"><?php _e( 'Username or email', 'woocommerce' ); ?></label> <input class="<?php echo $ss_framework->form_input_classes(); ?>" type="text" name="user_login" id="user_login" /></p>

	<?php else : ?>

        <p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce') ); ?></p>

        <div class="form-group">
            <label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="password" class="<?php echo $ss_framework->form_input_classes(); ?>" name="password_1" id="password_1" />
        </div>
        <div class="form-group">
            <label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="password" class="<?php echo $ss_framework->form_input_classes(); ?>" name="password_2" id="password_2" />
        </div>

        <input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
        <input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />

    <?php endif; ?>

    <?php echo $ss_framework->clearfix(); ?>

    <p class="form-row"><input type="submit" class="<?php echo $ss_framework->button_classes( 'primary', 'medium', null, null ); ?>" name="wc_reset_password" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'woocommerce' ) : __( 'Save', 'woocommerce' ); ?>" /></p>
	<?php wp_nonce_field( $args['form'] ); ?>

</form>