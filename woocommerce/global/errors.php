<?php

if ( !defined( 'ABSPATH' ) ) exit;

if ( !$errors ) :
	return;
endif; 

global $ss_framework;
?>

<div class="wrap">
	<?php foreach ( $errors as $error ) : ?>
		<?php $content = wp_kses_post( $error ); ?>
		<?php echo $ss_framework->alert( 'danger', $content, null, 'woocommerce_error', true ); ?>
	<?php endforeach; ?>
</div>