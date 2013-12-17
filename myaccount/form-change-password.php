<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php $woocommerce->show_messages(); ?>

<div class="col-sm-4 col-sm-offset-4">
<form action="<?php echo esc_url( get_permalink(woocommerce_get_page_id('change_password')) ); ?>" method="post" class="form">

	<p class="form-group">
		<label for="password_1"><?php _e('New password', 'woocommerce'); ?> <span class="required">*</span></label> <br>
		<input type="password" class="form-control" name="password_1" id="password_1" />
	</p>
	<p class="form-group">
		<label for="password_2"><?php _e('Re-enter new password', 'woocommerce'); ?> <span class="required">*</span></label> <br>
		<input type="password" class="form-control" name="password_2" id="password_2" />
	</p>

	<p class="form-group text-center"><input type="submit" class="button btn theme" name="change_password" value="<?php _e('Save', 'woocommerce'); ?>" /></p>

	<?php $woocommerce->nonce_field('change_password')?>
	<input type="hidden" name="action" value="change_password" />

</form>
</div>