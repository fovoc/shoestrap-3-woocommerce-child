<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

<div class="col2-set row " id="customer_login">

	<div class="col-1 col-sm-6">

<?php endif; ?>

		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#login"><i class="fa fa-lock"></i> <?php _e('Returning Customer', 'woocommerce'); ?></a></li>
		  <li><a href="#forgot"><i class="fa fa-question"></i> <?php _e('Lost Password', 'woocommerce'); ?></a></li>
		</ul>
		
		<div class="tab-content">

			<!-- Login -->
			<div class="tab-pane active" id="login">
				
				<form method="post" class="login form-horizontal">
					
					<div class="form-group">
						<label for="username" class="control-label"><?php _e('Username/email', 'woocommerce'); ?> <span class="required">*</span></label>
						<input type="text" class="input-text form-control" name="username" id="username" />	
					</div>
					<div class="form-group">
						<label for="password" class="control-label"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>					
						<input class="input-text form-control" type="password" name="password" id="password" />
						
					</div>
					
					<div class="form-group">
							<?php $woocommerce->nonce_field('login', 'login') ?>
							<input type="submit" class="button btn theme" name="login" value="<?php _e('Login', 'woocommerce'); ?>" />
					</div>
				</form>
			</div>
			
			<div class="tab-pane" id="forgot">
				<p class="padding">Click <a href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>" class="theme">here</a> to retrieve your password </p>
			</div>
			
		</div>
		

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="col-2 col-sm-6">
	
		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#register"><i class="fa fa-pencil"></i> <?php _e('Register', 'woocommerce'); ?></a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="register">
			
			<form method="post" class="register form-horizontal">

				<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>
	
					<div class="form-group">
						<label for="reg_username" class="control-label"><?php _e('Username', 'woocommerce'); ?> <span class="required">*</span></label>
						<input type="text" class="input-text form-control" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
					</div>
	
					<div class="form-group">
	
				<?php else : ?>
	
					<div class="form-group">
	
				<?php endif; ?>
	
						<label class="control-label" for="reg_email"><?php _e('Email', 'woocommerce'); ?> <span class="required">*</span></label>
						<input type="email" class="input-text form-control" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
					
					</div>
	
				<div class="clear"></div>
	
				<div class="form-group">
					<label class="control-label" for="reg_password"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="password" class="input-text form-control" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
				</div>
				<div class="form-group">
					<label class="control-label" for="reg_password2"><?php _e('Re-enter password', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="password" class="input-text form-control" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
				</div>
	
				<!-- Spam Trap -->
				<div class="form-group" style="display:none">
					<label class="control-label" for="trap">Anti-spam</label>
					<input type="text" name="email_2" id="trap" />
				</div>
	
				<?php do_action( 'register_form' ); ?>
	
				<div class="form-group">
						<?php $woocommerce->nonce_field('register', 'register') ?>
						<input type="submit" class="button btn btn-primary" name="register" value="<?php _e('Register', 'woocommerce'); ?>" />
				</div>
	
			</form>
			
			</div>
		</div>		

	</div>

</div>
<?php endif; ?>
<?php do_action('woocommerce_after_customer_login_form');