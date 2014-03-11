<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;

global $ss_framework;

$content = '<ul class="woocommerce-error">';

foreach ( $messages as $message ) : 
	$content .= '<li>'. echo wp_kses_post( $message ); .'</li>';
endforeach; 

$content .= '</ul>';

echo $ss_framework->alert( 'danger', $content, null, null, true ); ?>
