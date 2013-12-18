<?php



/*
 * Enqueue stylesheets and scripts
 */
if ( !function_exists( 'shoestrap_slider_enqueue_resources' ) ) :
function shoestrap_slider_enqueue_resources() {
	wp_enqueue_style( 'flexslider', get_stylesheet_directory_uri() .  '/assets/css/flexslider.css', false, null );
	wp_register_script( 'shoestrap_slider', get_stylesheet_directory_uri() . '/assets/js/jquery.flexslider-min.js', false, null, true );
	wp_enqueue_script( 'shoestrap_slider' );
}
endif;
add_action( 'wp_enqueue_scripts', 'shoestrap_slider_enqueue_resources', 102 );

/*
 * The script required for the sliders.
 */
if ( !function_exists( 'shoestrap_slider_gallery_script' ) ) :
function shoestrap_slider_gallery_script() {
	$script = '$("' . $element . '").flexslider({ animation: "slide" });';
	$script = '
	$("#carousel").flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 120,
		itemMargin: 0,
		asNavFor: "#slider"
	});

	$("#slider").flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#carousel"
	});';
	echo '<script>$(window).load(function() {' . $script . '});</script>';
}
endif;
add_action( 'wp_footer', 'shoestrap_slider_gallery_script' );