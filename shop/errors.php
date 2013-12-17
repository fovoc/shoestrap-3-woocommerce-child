<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $errors ) return;
?>
<div class="wrap">
<div class="woocommerce_error alert alert-danger">
	<?php foreach ( $errors as $error ) : ?>
		<?php echo wp_kses_post( $error ); ?>
	<?php endforeach; ?>
</div>	
</div>