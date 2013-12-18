<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( !$post->post_excerpt ) :
	return;
endif; ?>

<div itemprop="description">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
</div>