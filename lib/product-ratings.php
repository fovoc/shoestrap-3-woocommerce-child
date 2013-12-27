<?php


function shoestrap_get_rating_html( $rating = null ) {
	global $product;

	if ( ! is_numeric( $rating ) ) {
		$rating = $product->get_average_rating();
	}

	if ( $rating > 0 ) {

		$rating_html  = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating ) . '">';
		$rating_html .= '<span class="rating" style="width:' . ( ( $rating / 5 ) * 100 ) . '%">&#9733;&#9733;&#9733;&#9733;&#9733;' . __( 'out of 5', 'woocommerce' ) . '</span>';
		$rating_html .= '<div class="rating-stars">&#9734;&#9734;&#9734;&#9734;&#9734;</div>';
		$rating_html .= '</div>';

		return $rating_html;
	}
}