<?php

if ( !defined( 'REDUX_OPT_NAME' ) )
	define( 'REDUX_OPT_NAME', 'shoestrap' );

if ( class_exists( 'WooCommerce' ) ) {
	// Add support for WooCommerce
	add_theme_support( 'woocommerce' );

	// Remove default stylesheets for WooCommerce 2.1 and above
	// add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	function shoestrap_woo_include_files() {
		require_once locate_template( 'lib/admin-options.php' );
		require_once locate_template( 'lib/slider.php' );
		require_once locate_template( 'lib/product-classes.php' );
		require_once locate_template( 'lib/product-thumbnails.php' );
	}
	add_action( 'shoestrap_include_files', 'shoestrap_woo_include_files' );


	// Remove default WooCommerce titles
	add_filter( 'woocommerce_show_page_title', '__return_false' );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

	// Remove meta-data in Woo pages
	if ( is_woocommerce() ) 
		remove_action( 'shoestrap_entry_meta' );

	// Reposition count results
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 9 );


	add_filter( 'shoestrap_compiler', 'shoestrap_woocommerce_styles' );
	add_filter( 'foundation_scss', 'shoestrap_woocommerce_styles' );
	function shoestrap_woocommerce_styles( $styles ) {
		global $ss_framework;

		// get the filename
		if ( isset( $ss_framework->defines['shortname'] ) ) {
			$filename = $ss_framework->defines['shortname'];

			// get the filetype
			if ( isset( $ss_framework->defines['compiler'] ) ) {
				if ( $ss_framework->defines['compiler'] == 'sass_php' ) {
					$filetype = 'scss';
				} elseif ( $ss_framework->defines['compiler'] == 'less_php' ) {
					$filetype = 'less';
				}
			}
		}

		if ( isset( $filename ) && isset( $filetype ) ) {
			if ( file_exists( get_stylesheet_directory() . '/assets/' . $filename . '.' . $filetype ) ) {
				$styles .= file_get_contents( get_stylesheet_directory() . '/assets/' . $filename . '.' . $filetype );
			}
		}

		return $styles;
	}


	add_filter( 'shoestrap_compiler_output', 'shoestrap_woo_hijack_compiler' );
	function shoestrap_woo_hijack_compiler( $css ) {
		$css = str_replace( '/assets/less/woocommerce.less', '/assets/', $css );
		return $css;
	}


	/*
	 * JS assets
	 */
	function shoestrap_woo_assets() {
		global $ss_framework;
		$infinitescroll = shoestrap_getVariable( 'shoestrap_woo_infinite_scroll' );
		$masonry 				= shoestrap_getVariable( 'shoestrap_woo_masorny' );
		$sort_filters		= shoestrap_getVariable( 'shoestrap_woo_isotope_sort_filter' );

		if ( is_woocommerce() ) {
			// Register && Enqueue Isotope
			wp_register_script('shoestrap_isotope', get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.min.js', false, null, true);
			wp_enqueue_script('shoestrap_isotope');
			// Register && Enqueue Isotope-Sloppy-Masonry
			wp_register_script('shoestrap_isotope_sloppy_masonry', get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.sloppy-masonry.min.js', false, null, true);
			wp_enqueue_script('shoestrap_isotope_sloppy_masonry');
			
			if ( $sort_filters == 1 ) {
			// Register && Enqueue Multiselect
				if ( $ss_framework->defines['shortname'] == 'bootstrap' ) {
					wp_register_script('shoestrap_bootstrap_multiselect', get_stylesheet_directory_uri() . '/assets/js/bootstrap-multiselect.js', false, null, true);
					wp_enqueue_script('shoestrap_bootstrap_multiselect');
				}
				elseif ( $ss_framework->defines['shortname'] == 'foundation' ) {
					wp_register_script('shoestrap_foundation_multiselect', get_stylesheet_directory_uri() . '/assets/js/foundation-multiselect.js', false, null, true);
					wp_enqueue_script('shoestrap_foundation_multiselect');
				}
			}

			if ( $masonry != 1 ) {
				// Register && Enqueue jQuery EqualHeights
				wp_register_script('shoestrap_woo_equalheights', get_stylesheet_directory_uri() . '/assets/js/jquery.equalheights.min.js', false, null, true);
				wp_enqueue_script('shoestrap_woo_equalheights');
			}

			if ( $infinitescroll == 1 ) {
				// Register && Enqueue Infinite Scroll
				wp_register_script( 'shoestrap_woo_infinitescroll', get_stylesheet_directory_uri() . '/assets/js/jquery.infinitescroll.min.js', false, null, true );
				wp_enqueue_script( 'shoestrap_woo_infinitescroll' );
				wp_register_script( 'shoestrap_woo_imagesloaded', get_stylesheet_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', false, null, true );
				wp_enqueue_script( 'shoestrap_woo_imagesloaded' );
			}
		}
	}
	add_action( 'wp_head', 'shoestrap_woo_assets', 99 );

	/*
	 * Load our custom scripts
	 */
	function shoestrap_load_scripts() {
		wp_enqueue_script('shoestrap_script', get_stylesheet_directory_uri() . '/assets/js/script.js');
		wp_localize_script('shoestrap_script', 'shoestrap_script_vars', array(
				'is_woo'          => is_woocommerce(),
				'masonry' 				=> shoestrap_getVariable( 'shoestrap_woo_masorny' ),
				'infinitescroll' 	=> shoestrap_getVariable( 'shoestrap_woo_infinite_scroll' ),
				'sort_filters'		=> shoestrap_getVariable( 'shoestrap_woo_isotope_sort_filter' ),
				'no_filters'			=>  __( 'No filters', 'shoestrap_edd' ),
				'msgText' 				=> "<div class='progress progress-striped active' style='width:220px;margin-bottom:0px;'><div class='progress-bar progress-bar-" . __( shoestrap_getVariable( 'shoestrap_woo_loading_color' ) ) . "' style='width: 100%;'><span class='edd_bar_text'>" . __( shoestrap_getVariable( 'shoestrap_woo_loading_text' ) ) . "<span></div></div>",
				'finishedMsg' 		=> "<div class='progress progress-striped active' style='width:220px;margin-bottom:0px;'><div class='progress-bar progress-bar-" . __( shoestrap_getVariable( 'shoestrap_woo_end_color' ) ) . "' style='width: 100%;'><span class='edd_bar_text'>" . __( shoestrap_getVariable( 'shoestrap_woo_end_text' ) ) . "<span></div></div>"
			)
		);
	}
	add_action('wp_enqueue_scripts', 'shoestrap_load_scripts', 99);


	/*
	 * Add template parts for sorting && filtering.
	 */
	function shoestrap_woo_isotope_templates() {
		if ( is_woocommerce() ) {
			get_template_part( 'templates/shoestrap-woo', 'sorting' );
			get_template_part( 'templates/shoestrap-woo', 'filtering' );
			echo '<div class="clearfix"></div>';
		}
	}

	function shoestrap_woo_enable_isotope_sort_filter() {
		if ( shoestrap_getVariable( 'shoestrap_woo_isotope_sort_filter' ) == 1 )
			add_action( 'woocommerce_before_shop_loop', 'shoestrap_woo_isotope_templates', 99999 );
	}
	add_action( 'wp', 'shoestrap_woo_enable_isotope_sort_filter' );



	/*
	 * This function is a mini loop that will go through all the items currently displayed
	 * Retrieve their terms, and then return the list items required by isotope
	 * to be properly displayed inside the filters.
	 */
	function shoestrap_woo_products_terms_filters( $vocabulary, $echo = false ) {
		global $post;
		$tags = array();
		$output = '';
		while (have_posts()) : the_post();
			$terms = wp_get_post_terms( $post->ID, $vocabulary );
			foreach ( $terms as $term ) {
				$tags[] = $term->term_id;
			}
		endwhile;

		$tags = array_unique( $tags );

		foreach ( $tags as $tagid ) {
			$tag = get_term( $tagid, $vocabulary );
			$tagname = $tag->name;
			$tagslug = $tag->slug;
			$prefix = str_replace('_', '-', $vocabulary);
			$output .= '<option value=".' . $prefix . '-' . $tagslug . '">' . $tagname . '</option>';
		}

		if ( $echo )
			echo $output;
		else
			return $output;
	}
}