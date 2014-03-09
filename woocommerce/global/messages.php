<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! $messages ) :
	return;
endif; ?>

<div class="wrap">
	<?php foreach ( $messages as $message ) : ?>
		<?php $content = wp_kses_post( $message ); ?>
		<?php echo $ss_framework->alert( 'success', $content, null, 'woocommerce_message', true ); ?>
	<?php endforeach; ?>
</div>
