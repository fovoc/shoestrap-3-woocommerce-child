<?php

/*
 * Isotope controls for filtering tags
 */
$terms = get_terms( 'product_tag' );
$count = count( $terms );
if ( $count > 0 ) : ?>
<div class="btn-group filter-isotope pull-right">
	<a class="btn btn-default" data-filter="*"><?php _e( 'All Tags', 'shoestrap_woo' ); ?></a>
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		<span class="caret"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<?php shoestrap_woo_products_terms_filters( 'product_tag', true ); ?>
	</ul>
</div><?php endif;