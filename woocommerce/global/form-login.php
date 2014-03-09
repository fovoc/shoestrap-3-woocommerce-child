<?php

if ( ! defined( 'ABSPATH' ) ) exit;

global $woocommerce, $ss_framework;

if ( is_user_logged_in() ) :
	return;
endif; ?>

<?php echo $ss_framework->open_row( 'div', null, null, null ); ?>
	<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 12 ), null, null ); ?>
		<form method="post" class="login form" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
			<?php if ( $message ) : ?>
				<?php echo wpautop( wptexturize( $message ) ); ?>
			<?php endif; ?>

			<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 6 ), null, 'form-group' ); ?>
				<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="<?php echo $ss_framework->form_input_classes(); ?>" name="username" id="username" />
			<?php echo $ss_framework->close_row( 'div' ); ?>

			<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 6 ), null, 'form-group' ); ?>
				<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input class="<?php echo $ss_framework->form_input_classes(); ?>" type="password" name="password" id="password" />
			<?php echo $ss_framework->close_row( 'div' ); ?>

			<div class="form-group">
				<?php wp_nonce_field( 'login', 'login' ); ?>
				<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 6 ), null, null ); ?>
					<input type="submit" class="<?php echo $ss_framework->button_classes( 'primary', 'block', null, null ); ?>" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
					<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
				<?php echo $ss_framework->close_col( 'div' ); ?>
				<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 6 ), null, null ); ?>
					<a class="<?php echo $ss_framework->button_classes( 'warning', 'block', null, 'lost_password' ); ?>" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e( 'Lost Password?', 'woocommerce' ); ?></a>
				<?php echo $ss_framework->close_col( 'div' ); ?>
			</div>
		</form>
	<?php echo $ss_framework->close_col( 'div' ); ?>
<?php echo $ss_framework->close_row( 'div' ); ?>