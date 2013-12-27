<?php


/*
 * Add classes to single products on product archives
 */
function shoestrap_woo_conditional_post_classes() {
	if ( is_woocommerce() && !is_product() )
		add_filter( 'post_class', 'shoestrap_woo_post_classes' );
}
add_action( 'wp', 'shoestrap_woo_conditional_post_classes' );


/*
 * the classes to add to single products on product archives
 */
if ( !function_exists( 'shoestrap_woo_post_classes' ) ) :
function shoestrap_woo_post_classes( $classes ) {
	global $post;
	// get the specified width ( narrow/normal/wide )
	$mode = shoestrap_getVariable( 'shoestrap_woo_posts_columns', 'normal' );
	
	// Remove unnecessary classes
	foreach (range(0, 12) as $number) :
		$remove_classes[] = 'col-xs-'.$number.'';
		$remove_classes[] = 'col-sm-'.$number.'';
		$remove_classes[] = 'col-md-'.$number.'';
		$remove_classes[] = 'col-lg-'.$number.'';
	endforeach;

	$classes = array_diff( $classes, $remove_classes );

	$new_classes = shoestrap_woo_post_extra_classes();

	$classes = array_merge( $classes, $new_classes );

	// If this is NOT a singular post/page etc, return the classes
	if ( !is_singular() )
		return $classes;
}
endif;


if ( !function_exists( 'shoestrap_woo_post_extra_classes' ) ) :
function shoestrap_woo_post_extra_classes() {
	global $post;

	// get the specified width ( narrow/normal/wide )
	$mode = shoestrap_getVariable( 'shoestrap_woo_posts_columns', 'normal' );
	
	$classes[] = '';
	// calculate the css classes based on the above selection
	if ( $mode == 'narrow' ) :
		$classes[] = 'col-lg-3';
		$classes[] = 'col-md-4';
		$classes[] = 'col-sm-6';
		$classes[] = 'col-xs-12';
	elseif ( $mode == 'normal' ) :
		$classes[] = 'col-lg-4';
		$classes[] = 'col-md-6';
		$classes[] = 'col-sm-6';
		$classes[] = 'col-xs-12';
	else :
		$classes[] = 'col-lg-6';
		$classes[] = 'col-md-6';
		$classes[] = 'col-sm-12';
		$classes[] = 'col-xs-12';
	endif;

	return $classes;
}
endif;