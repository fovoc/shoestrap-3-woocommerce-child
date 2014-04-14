<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query, $ss_framework;

if ( ! woocommerce_products_will_display() || shoestrap_getVariable( 'shoestrap_woo_infinite_scroll' ) == 1 )
	return;

$paged    = max( 1, $wp_query->get( 'paged' ) );
$per_page = $wp_query->get( 'posts_per_page' );
$total    = $wp_query->found_posts;
$first    = ( $per_page * $paged ) - $per_page + 1;
$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
$content  = '';

if ( 1 == $total ) {
	$content = _e( 'Showing the single result', 'woocommerce' );
} elseif ( $total <= $per_page || -1 == $per_page ) {
	$content = __( 'Showing all '.$total.' results', 'woocommerce' );
} else {
	$content = _x( 'Showing '.$first.'–'.$last.' of '.$total.' results', 'woocommerce' );
}

echo $ss_framework->alert( 'info', $content, null, 'woocommerce-result-count', true );
?>