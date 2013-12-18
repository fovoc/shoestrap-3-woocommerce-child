<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! $messages ) :
	return;
endif; ?>

<?php foreach ( $messages as $message ) : ?>
	<div class="wrap">
		<div class="woocommerce_message alert alert-success">
			<?php echo wp_kses_post( $message ); ?>
		</div>
	</div>
<?php endforeach;