<?php


/*
 * Gridder Addon options
 */
if ( !function_exists( 'shoestrap_module_woo_options' ) ) :
function shoestrap_module_woo_options( $sections ) {

	$section = array(
		'title' => __( 'WooCommerce', 'shoestrap_woo' ),
		'icon'  => 'el-icon-shopping-cart'
	);

	$fields[] = array( 
		'title'     => __( 'Enable Infinite Scroll', 'shoestrap_woo' ),
		'desc'      => __( 'Default: On.', 'shoestrap_woo' ),
		'id'        => 'shoestrap_woo_infinite_scroll',
		'default'   => 1,
		'type'      => 'switch'
	);

	$fields[] = array( 
		'title'     => __( 'Loading text', 'shoestrap_woo' ),
		'desc'      => __( 'The text inside the progress bar as next set is loading.', 'shoestrap_woo' ),
		'id'        => 'shoestrap_woo_loading_text',
		'default'   => 'Loading...',
		'type'      => 'text',
		'required'  => array( 'shoestrap_woo_infinite_scroll','=',array( '1' ) ),
	);

	$fields[] = array( 
		'title'     => __( 'End text', 'shoestrap_woo' ),
		'desc'      => __( 'The text inside the progress bar when no more posts are available.', 'shoestrap_woo' ),
		'id'        => 'shoestrap_woo_end_text',
		'default'   => 'End of list',
		'type'      => 'text',
		'required'  => array( 'shoestrap_woo_infinite_scroll','=',array( '1' ) ),
	);

	$fields[] = array( 
		'title'     => __( 'Loading progress bar color', 'shoestrap_woo' ),
		'desc'      => __( 'Select between standard Bootstrap\'s progress bars classes', 'shoestrap_woo' ),
		'id'        => 'shoestrap_woo_loading_color',
		'default'   => 'default',
		'type'      => 'select',
		'customizer'=> array(),
		'options'   => array( 
			'default' => 'Default',
			'info'    => 'Info',
			'success' => 'Success',
			'warning' => 'Warning',
			'danger'  => 'Danger'
		),
		'required'  => array( 'shoestrap_woo_infinite_scroll','=',array( '1' ) ),
	);

	$fields[] = array( 
		'title'     => __( 'End progress bar color', 'shoestrap_woo' ),
		'desc'      => __( 'Select between standard Bootstrap\'s progress bars classes', 'shoestrap_woo' ),
		'id'        => 'shoestrap_woo_end_color',
		'default'   => 'default',
		'type'      => 'select',
		'customizer'=> array(),
		'options'   => array( 
			'default' => 'Default',
			'info'    => 'Info',
			'success' => 'Success',
			'warning' => 'Warning',
			'danger'  => 'Danger'
		),
		'required'  => array( 'shoestrap_woo_infinite_scroll','=',array( '1' ) ),
	);

	$fields[] = array(
		'title'     => __( 'Products Width', 'shoestrap_woo' ),
		'desc'      => __( 'Select the width of single products. This eventually changes the number of columns.', 'shoestrap_woo' ),
		'id'        => 'shoestrap_woo_posts_columns',
		'default'   => 'normal',
		'type'      => 'select',
		'options'   => array(
			'narrow' => 'Narrow',
			'normal' => 'Normal',
			'wide'   => 'Wide'
		)
	);

	$fields[] = array( 
		'title'     => __( 'Enable Masonry', 'shoestrap_woo' ),
		'desc'      => __( 'Default: On. If disabled, equalheights.js trigger before all.', 'shoestrap_woo' ),
		'id'        => 'shoestrap_woo_masorny',
		'default'   => 1,
		'type'      => 'switch'
	);

	$fields[] = array( 
		'title'     => __( 'Enable Isotope Sorting && Filtering', 'shoestrap_woo' ),
		'desc'      => __( 'Default: Off. Preferable for short product lists.', 'shoestrap_woo' ),
		'id'        => 'shoestrap_woo_isotope_sort_filter',
		'default'   => 0,
		'type'      => 'switch'
	);

	$section['fields'] = $fields;

	$section = apply_filters( 'shoestrap_module_woo_options_modifier', $section );
	
	$sections[] = $section;
	return $sections;
}
endif;
add_filter( 'redux/options/' . REDUX_OPT_NAME . '/sections', 'shoestrap_module_woo_options', 16 );
