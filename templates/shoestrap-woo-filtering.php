<?php

/*
 * Isotope controls for filtering
 */
$categories = get_terms( 'product_cat' );
$count_cat = count( $categories );
$tags = get_terms( 'product_tag' );
$count_tag = count( $tags );

if ( $count_cat > 0 || $count_tag > 0 ) : ?>

	<div class="filter pull-right">	
		<select multiple="multiple" style="display: none;">
			<option value="multiselect-all" selected="selected"> <?php _e( 'All', 'shoestrap_edd' ); ?></option>
	  		
	  		<?php if ( $count_cat > 0 ) { ?>
		  		<optgroup label="<?php _e( 'Categories', 'shoestrap_edd' ); ?>">
		  			<?php shoestrap_woo_products_terms_filters( 'product_cat', true ); ?>
		  		</optgroup>
		  	<?php } ?>

		  	<?php if ( $count_tag > 0 ) { ?>
		  		<optgroup label="<?php _e( 'Tags', 'shoestrap_edd' ); ?>">
		  			<?php shoestrap_woo_products_terms_filters( 'product_tag', true ); ?>
		  		</optgroup>
		  	<?php } ?>
		  	
		</select>
	</div>
	
<?php endif;