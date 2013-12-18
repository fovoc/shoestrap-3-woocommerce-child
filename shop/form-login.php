<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if (is_user_logged_in()) return;
?>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<form method="post" class="login form" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

			<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

			<div class="form-group">
				<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="form-control" name="username" id="username" />
			</div>
			<div class="form-group">
				<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input class="form-control" type="password" name="password" id="password" />
			</div>
			<div class="form-group text-center">
				<?php $woocommerce->nonce_field('login', 'login') ?>
				<input type="submit" class="btn btn-default theme" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
				<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
				<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e( 'Lost Password?', 'woocommerce' ); ?></a>
			</div>

		</form>
	</div>
</div>