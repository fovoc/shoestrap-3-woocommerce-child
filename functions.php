<?php

// Add support for WooCommerce
add_theme_support( 'woocommerce' );

// Remove default stylesheets for WooCommerce 2.1 and above
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Prioritize loading of some necessary core modules
if ( file_exists( get_template_directory() . '/lib/modules/core.redux/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core.redux/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/core/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/core.layout/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core.layout/module.php';

if ( file_exists( get_template_directory() . '/lib/modules/core.images/module.php' ) )
	require_once get_template_directory() . '/lib/modules/core.images/module.php';

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
		// Register && Enqueue Isotope
		wp_register_script('shoestrap_isotope', get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.min.js', false, null, true);
		wp_enqueue_script('shoestrap_isotope');
		// Here trigger our scripts
		add_action( 'wp_footer', 'shoestrap_woo_custom_script', 99 );
		add_action( 'wp_head', 'shoestrap_woo_header_css', 98 );
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
 * JS script
 */
if ( !function_exists( 'shoestrap_woo_custom_script' ) ) :
function shoestrap_woo_custom_script() { 
	echo '<script>$(function(){ 
			var $container = $(".products");';

		$masonry = shoestrap_getVariable( 'shoestrap_woo_masorny' );
		if ( $masonry != 1 ) :
			echo '
    	$(".products .product").equalHeights();
			';
		endif;
			echo '
				$container.isotope({
				  layoutMode: "sloppyMasonry",
				  itemSelector: ".products .product",
				  animationEngine: "best-available",
				  // get sort data-filter
				  getSortData : {
				    name : function ( $elem ) {
				      return $elem.find(".product-title a").text();
				    },
				    price : function ( $elem ) {
			      	return parseInt( $elem.find(".plain-price").text(), 10 );
				    }
				  }
				});
			';

		echo '
			// FILTERING
			$(".filter-isotope a").click(function(){
			  var selector = $(this).attr("data-filter");
			  $container.isotope({ filter: selector });
			  return false;
			});

			// SORTING Ascending
  		$(".isotope-sort .true a").click(function(){
			  // get href attribute, minus the "#"
			  var sortName = $(this).attr("href").slice(1);
			  $container.isotope({ sortBy : sortName, sortAscending : true });
			  return false;
			});
			
			// SORTING Descending
			$(".isotope-sort .false a").click(function(){
			  // get href attribute, minus the "#"
			  var sortName = $(this).attr("href").slice(1);
			  $container.isotope({ sortBy : sortName, sortAscending : false });
			  return false;
			});
			
			// SORTING Default
			$(".isotope-sort .sort-default").click(function(){
			  $container.isotope({ sortBy : "original-order" });
			  return false;
			});';

	$infinitescroll = shoestrap_getVariable( 'shoestrap_woo_infinite_scroll' );
	if ( $infinitescroll == 1 ) :
		$msgText = "";
		$msgText .= "<div class='progress progress-striped active' style='width:220px;margin-bottom:0px;'>";
			$msgText .= "<div class='progress-bar progress-bar-" . __( shoestrap_getVariable( 'shoestrap_woo_loading_color' ) ) . "' style='width: 100%;'>";
				$msgText .= "<span class='edd_bar_text'>" . __( shoestrap_getVariable( 'shoestrap_woo_loading_text' ) ) . "<span>";
			$msgText .= "</div>";
		$msgText .= "</div>";

		$finishedMsg = "";
		$finishedMsg .= "<div class='progress progress-striped active' style='width:220px;margin-bottom:0px;'>";
			$finishedMsg .= "<div class='progress-bar progress-bar-" . __( shoestrap_getVariable( 'shoestrap_woo_end_color' ) ) . "' style='width: 100%;'>";
				$finishedMsg .= "<span class='edd_bar_text'>" . __( shoestrap_getVariable( 'shoestrap_woo_end_text' ) ) . "<span>";
			$finishedMsg .= "</div>";
		$finishedMsg .= "</div>";

		echo '
					$container.infinitescroll({
						navSelector  : ".pagination",
						nextSelector : ".pagination li a.next",
						itemSelector : ".products .product",
						loading: {
							msgText: "'; echo $msgText; echo'",
							finishedMsg: "'; echo $finishedMsg; echo'"
						}
						// trigger Isotope as a callback
						},function( newElements ) {
							// hide new items while they are loading
							var newElems = $( newElements ).css({ opacity: 0 });
							// ensure that images load before all
							$(newElems).imagesLoaded(function(){
							// show elems now they are ready
							$(newElems).animate({ opacity: 1 });';
								if ( $masonry != 1 ):
									echo '
								// re-calculate equalheights for all elements
								$(".products .product").equalHeights();
								';
								endif;
								echo '
								$container.isotope( "insert", $(newElems), true );
							});
						});';
	endif;
	echo '});</script>';
}
endif;


/*
 * Some additional CSS rules that must be added for this plugin
 */
if ( !function_exists( 'shoestrap_woo_header_css' ) ) :
function shoestrap_woo_header_css() {
	?>
	<style>
	.dropdown-menu li.sort, .dropdown-menu, li.filter { padding-left: .5em; }
	.products .product { margin-bottom: 2em; }
	.open > .dropdown-menu { padding: 0; }
	/**** Isotope filtering ****/
	.isotope-item {
	  z-index: 2;
	}
	.isotope-hidden.isotope-item {
	  pointer-events: none;
	  z-index: 1;
	}
	.isotope,
	.isotope .isotope-item {
	  /* change duration value to whatever you like */
	  -webkit-transition-duration: 0.8s;
	     -moz-transition-duration: 0.8s;
	      -ms-transition-duration: 0.8s;
	       -o-transition-duration: 0.8s;
	          transition-duration: 0.8s;
	}
	.isotope {
	  -webkit-transition-property: height, width;
	     -moz-transition-property: height, width;
	      -ms-transition-property: height, width;
	       -o-transition-property: height, width;
	          transition-property: height, width;
	}
	.isotope .isotope-item {
	  -webkit-transition-property: -webkit-transform, opacity;
	     -moz-transition-property:    -moz-transform, opacity;
	      -ms-transition-property:     -ms-transform, opacity;
	       -o-transition-property:      -o-transform, opacity;
	          transition-property:         transform, opacity;
	}
	/**** disabling Isotope CSS3 transitions ****/
	.isotope.no-transition,
	.isotope.no-transition .isotope-item,
	.isotope .isotope-item.no-transition {
	  -webkit-transition-duration: 0s;
	     -moz-transition-duration: 0s;
	      -ms-transition-duration: 0s;
	       -o-transition-duration: 0s;
	          transition-duration: 0s;
	}
	/**** styling required for Infinite Scroll ****/
	#infscr-loading {
  position: fixed;
  text-align: center;
  bottom: 30px;
  left: 50%;
  width: 220px;
  height: auto;
  padding-top: 0px;
  margin-left: -100px;
  z-index: 100;
  background: transparent ;
  overflow: hidden;
	}
	#infscr-loading img {
	  display: none;  
	}
	</style>
	<?php
}
endif;


/*
 * Add template parts for sorting && filtering.
 */
if ( !function_exists( 'shoestrap_woo_isotope_templates' ) ) :
function shoestrap_woo_isotope_templates() {
	if ( is_woocommerce() ) :
		get_template_part( 'templates/shoestrap-woo', 'sorting' );
		get_template_part( 'templates/shoestrap-woo', 'download_category' );
		get_template_part( 'templates/shoestrap-woo', 'download_tag' );
		echo '<div class="clearfix"></div>';
	endif;
}
endif;
add_action( 'woocommerce_before_shop_loop', 'shoestrap_woo_isotope_templates', 99999 );


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
		if ($vocabulary == 'product_cat') 
			$output .= '<li><a href="#" data-filter=".product-cat-' . $tagslug . '">' . $tagname . '</a></li>';
		if ($vocabulary == 'product_tag') 
			$output .= '<li><a href="#" data-filter=".product-tag-' . $tagslug . '">' . $tagname . '</a></li>';
	endforeach;

	if ( $echo ) :
		echo $output;
	else :
		return $output;
	endif;
}
endif;