<?php
/**
 * Displayed when no products are found matching the current query.
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/no-products-found.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $ss_framework;
?>

<?php echo $ss_framework->open_row( 'div', null, null, null ); ?>
	<?php echo $ss_framework->open_col( 'div', array( 'mobile' => 12 ), null, null, null ); ?>
		<div class="wrap">
			<?php echo $ss_framework->alert( 'info', __( 'No products found which match your selection.', 'woocommerce' ), null, 'woocommerce-info', true ); ?>
		</div>
	<?php echo $ss_framework->close_col( 'div' ); ?>
<?php echo $ss_framework->close_row( 'div' ); ?>