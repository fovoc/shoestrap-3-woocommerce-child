<?php

if ( !defined( 'REDUX_OPT_NAME' ) )
	define( 'REDUX_OPT_NAME', 'shoestrap' );

// Add support for WooCommerce
add_theme_support( 'woocommerce' );

// Remove default stylesheets for WooCommerce 2.1 and above
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Prioritize loading of some necessary core modules
if ( file_exists( get_template_directory() . '/lib/modules/redux/module.php' ) )
	require_once get_template_directory() . '/lib/modules/redux/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/core/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/layout/module.php' ) )
	require_once get_template_directory() . '/lib/modules/layout/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/blog/module.php' ) )
	require_once get_template_directory() . '/lib/modules/blog/module.php';

require_once locate_template( 'lib/admin-options.php' );
require_once locate_template( 'lib/slider.php' );
require_once locate_template( 'lib/wp-core-functions.php' );
require_once locate_template( 'lib/product-classes.php' );
require_once locate_template( 'lib/product-ratings.php' );
require_once locate_template( 'lib/product-thumbnails.php' );


// Remove default WooCommerce titles
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );


add_filter( 'shoestrap_compiler', 'shoestrap_woocommerce_styles' );
function shoestrap_woocommerce_styles( $bootstrap ) {
	return $bootstrap . '
	@import "' . get_stylesheet_directory() . '/assets/less/woocommerce.less";';
}


add_filter( 'shoestrap_compiler_output', 'shoestrap_woo_hijack_compiler' );
function shoestrap_woo_hijack_compiler( $css ) {
	$css = str_replace( '/assets/less/woocommerce.less', '/assets/', $css );
	return $css;
}


/*
 * JS assets
 */
if ( !function_exists( 'shoestrap_woo_assets' ) ) :
function shoestrap_woo_assets() {
	$infinitescroll = shoestrap_getVariable( 'shoestrap_woo_infinite_scroll' );
	$masonry 				= shoestrap_getVariable( 'shoestrap_woo_masorny' );

	if ( is_woocommerce() ) :
		// Register && Enqueue Bootstrap Multiselect
		wp_register_script('shoestrap_multiselect', get_stylesheet_directory_uri() . '/assets/js/bootstrap-multiselect.js', false, null, true);
		wp_enqueue_script('shoestrap_multiselect');
		// Register && Enqueue Isotope
		wp_register_script('shoestrap_isotope', get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.min.js', false, null, true);
		wp_enqueue_script('shoestrap_isotope');
		// Register && Enqueue Isotope-Sloppy-Masonry
		wp_register_script('shoestrap_isotope_sloppy_masonry', get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.sloppy-masonry.min.js', false, null, true);
		wp_enqueue_script('shoestrap_isotope_sloppy_masonry');

		if ( $masonry != 1 ) :
			// Register && Enqueue jQuery EqualHeights
			wp_register_script('shoestrap_woo_equalheights', get_stylesheet_directory_uri() . '/assets/js/jquery.equalheights.min.js', false, null, true);
			wp_enqueue_script('shoestrap_woo_equalheights');
		endif;

		if ( $infinitescroll == 1 ) :
			// Register && Enqueue Infinite Scroll
			wp_register_script( 'shoestrap_woo_infinitescroll', get_stylesheet_directory_uri() . '/assets/js/jquery.infinitescroll.min.js', false, null, true );
			wp_enqueue_script( 'shoestrap_woo_infinitescroll' );
			wp_register_script( 'shoestrap_woo_imagesloaded', get_stylesheet_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', false, null, true );
			wp_enqueue_script( 'shoestrap_woo_imagesloaded' );
		endif;

	endif;
}
endif;
add_action( 'wp_head', 'shoestrap_woo_assets', 99 );

/*
 * Load our custom scripts
 */
if ( !function_exists( 'shoestrap_load_scripts' ) ) :
	function shoestrap_load_scripts() {
		wp_enqueue_script('shoestrap_script', get_stylesheet_directory_uri() . '/assets/js/script.js');
		wp_localize_script('shoestrap_script', 'shoestrap_script_vars', array(
				'masonry' 				=> shoestrap_getVariable( 'shoestrap_woo_masorny' ),
				'infinitescroll' 	=> shoestrap_getVariable( 'shoestrap_woo_infinite_scroll' ),
				'no_filters'			=>  __( 'No filters', 'shoestrap_edd' ),
				'msgText' 				=> "<div class='progress progress-striped active' style='width:220px;margin-bottom:0px;'><div class='progress-bar progress-bar-" . __( shoestrap_getVariable( 'shoestrap_woo_loading_color' ) ) . "' style='width: 100%;'><span class='edd_bar_text'>" . __( shoestrap_getVariable( 'shoestrap_woo_loading_text' ) ) . "<span></div></div>",
				'finishedMsg' 		=> "<div class='progress progress-striped active' style='width:220px;margin-bottom:0px;'><div class='progress-bar progress-bar-" . __( shoestrap_getVariable( 'shoestrap_woo_end_color' ) ) . "' style='width: 100%;'><span class='edd_bar_text'>" . __( shoestrap_getVariable( 'shoestrap_woo_end_text' ) ) . "<span></div></div>"
			)
		);
	}
endif;
add_action('wp_enqueue_scripts', 'shoestrap_load_scripts', 99);


/*
 * Add template parts for sorting && filtering.
 */
if ( !function_exists( 'shoestrap_woo_isotope_templates' ) ) :
function shoestrap_woo_isotope_templates() {
	if ( is_woocommerce() ) :
		get_template_part( 'templates/shoestrap-woo', 'sorting' );
		get_template_part( 'templates/shoestrap-woo', 'filtering' );
		echo '<div class="clearfix"></div>';
	endif;
}
endif;

function shoestrap_woo_enable_isotope_sort_filter() {
	if ( shoestrap_getVariable( 'shoestrap_woo_isotope_sort_filter' ) == 1 )
		add_action( 'woocommerce_before_shop_loop', 'shoestrap_woo_isotope_templates', 99999 );
}
add_action( 'init', 'shoestrap_woo_enable_isotope_sort_filter' );



/*
 * This function is a mini loop that will go through all the items currently displayed
 * Retrieve their terms, and then return the list items required by isotope
 * to be properly displayed inside the filters.
 */
if ( !function_exists( 'shoestrap_woo_products_terms_filters' ) ) :
function shoestrap_woo_products_terms_filters( $vocabulary, $echo = false ) {
	global $post;
	$tags = array();
	$output = '';
	while (have_posts()) : the_post();
		$terms = wp_get_post_terms( $post->ID, $vocabulary );
		foreach ( $terms as $term ) :
			$tags[] = $term->term_id;
		endforeach;
	endwhile;

	$tags = array_unique( $tags );

	foreach ( $tags as $tagid ) :
		$tag = get_term( $tagid, $vocabulary );
		$tagname = $tag->name;
		$tagslug = $tag->slug;
		$prefix = str_replace('_', '-', $vocabulary);
		$output .= '<option value=".' . $prefix . '-' . $tagslug . '">' . $tagname . '</option>';
	endforeach;

	if ( $echo ) :
		echo $output;
	else :
		return $output;
	endif;
}
endif;