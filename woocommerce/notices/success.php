<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;

global $ss_framework;
?>

<?php foreach ( $messages as $message ) : ?>
	<?php $content = wp_kses_post( $message ); ?>
	<?php echo $ss_framework->alert( 'success', $content, null, 'woocommerce-message', true ); ?>
<?php endforeach;