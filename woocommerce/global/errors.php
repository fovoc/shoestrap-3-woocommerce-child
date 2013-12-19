<?php

if ( !defined( 'ABSPATH' ) ) exit;


if ( !$errors ) :
	return;
endif; ?>

<div class="wrap">
	<div class="woocommerce_error alert alert-danger">
		<?php foreach ( $errors as $error ) : ?>
			<?php echo wp_kses_post( $error ); ?>
		<?php endforeach; ?>
	</div>
</div>