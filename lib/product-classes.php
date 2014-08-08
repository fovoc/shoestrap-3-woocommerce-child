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
	global $post, $ss_framework, $ss_settings;

	// get the specified width ( narrow/normal/wide )
	$mode = $ss_settings['shoestrap_woo_posts_columns'];
	
	$classes[] = 'hentry';
	// calculate the css classes based on the above selection
	if ( $mode == 'narrow' ) :
		$classes[] = $ss_framework->column_classes( array( 'mobile' => 12, 'tablet' => 6, 'medium' => 4, 'large' => 3 ), null );
	elseif ( $mode == 'normal' ) :
		$classes[] = $ss_framework->column_classes( array( 'mobile' => 12, 'tablet' => 6, 'medium' => 6, 'large' => 4 ) , null );
	else :
		$classes[] = $ss_framework->column_classes( array( 'mobile' => 12, 'tablet' => 12, 'medium' => 6, 'large' => 6 ), null );
	endif;

	return $classes;
}
endif;