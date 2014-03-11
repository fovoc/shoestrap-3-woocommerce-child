<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $ss_framework;
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<?php echo $ss_framework->open_row( 'div', 'customer_login', 'col2-set', null ); ?>

	<?php echo $ss_framework->open_col( 'div', array( 'tablet' => 6 ), null, null, null ); ?>

<?php endif; ?>

		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#login" data-toggle="tab"><i class="el-icon-lock"></i> <?php _e('Returning Customer', 'woocommerce'); ?></a></li>
		  <li><a href="#forgot" data-toggle="tab"><i class="el-icon-question"></i> <?php _e('Lost Password', 'woocommerce'); ?></a></li>
		</ul>

		<div class="tab-content">

			<!-- Login -->
			<div class="tab-pane active" id="login">

				<form method="post" class="login form-horizontal">

					<div class="form-group">
						<label for="username" class="control-label"><?php _e('Username/email', 'woocommerce'); ?> <span class="required">*</span></label>
						<input type="text" class="input-text <?php echo $ss_framework->form_input_classes(); ?>" name="username" id="username" />
					</div>
					<div class="form-group">
						<label for="password" class="control-label"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
						<input class="input-text <?php echo $ss_framework->form_input_classes(); ?>" type="password" name="password" id="password" />

					</div>

					<div class="form-group">
							<?php wp_nonce_field( 'login', 'login' ); ?>
							<input type="submit" class="<?php echo $ss_framework->button_classes( 'primary', 'block', null, 'theme' ); ?>" name="login" value="<?php _e('Login', 'woocommerce'); ?>" />
					</div>
				</form>
			</div>

			<div class="tab-pane" id="forgot">
				<p class="padding">Click <a href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>" class="<?php echo $ss_framework->button_classes( 'link', 'medium', null, 'theme' ); ?>">here</a> to retrieve your password </p>
			</div>

		</div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<?php echo $ss_framework->close_col( 'div' ); ?>

	<?php echo $ss_framework->open_col( 'div', array( 'tablet' => 6 ), null, 'col-2', null ); ?>

		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#register" data-toggle="tab"><i class="el-icon-pencil"></i> <?php _e('Register', 'woocommerce'); ?></a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="register">

			<form method="post" class="register form-horizontal">

				<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

					<div class="form-group">
						<label for="reg_username" class="control-label"><?php _e('Username', 'woocommerce'); ?> <span class="required">*</span></label>
						<input type="text" class="input-text <?php echo $ss_framework->form_input_classes(); ?>" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
					</div>

					<div class="form-group">

				<?php else : ?>

					<div class="form-group">

				<?php endif; ?>

						<label class="control-label" for="reg_email"><?php _e('Email', 'woocommerce'); ?> <span class="required">*</span></label>
						<input type="email" class="input-text <?php echo $ss_framework->form_input_classes(); ?>" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />

					</div>

				<?php echo $ss_framework->clearfix(); ?>

				<div class="form-group">
					<label class="control-label" for="reg_password"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="password" class="input-text <?php echo $ss_framework->form_input_classes(); ?>" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
				</div>
				<div class="form-group">
					<label class="control-label" for="reg_password2"><?php _e('Re-enter password', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="password" class="input-text <?php echo $ss_framework->form_input_classes(); ?>" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
				</div>

				<!-- Spam Trap -->
				<div class="form-group" style="display:none">
					<label class="control-label" for="trap">Anti-spam</label>
					<input type="text" name="email_2" id="trap" />
				</div>

				<?php do_action( 'register_form' ); ?>

				<div class="form-group">
						<?php wp_nonce_field( 'register', 'register' ); ?>
						<input type="submit" class="<?php echo $ss_framework->button_classes( 'primary', 'medium', null, null ); ?>" name="register" value="<?php _e('Register', 'woocommerce'); ?>" />
				</div>

			</form>

			</div>
		<?php echo $ss_framework->close_col( 'div' ); ?>
<?php echo $ss_framework->close_row( 'div' ); ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>