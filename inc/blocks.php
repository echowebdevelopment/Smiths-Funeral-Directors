<?php
/**********************************************************
 *
 * File:         Blocks
 * Description:  ACF blocks function call
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/01/24
 *
 **********************************************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// register blocks
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {

	$blocks = array(
		'faqs-block',
		'text-image-block',
		'page-title-block',
		'usp-banner-block',
		'image-divider-block',
		'advert-block',
		'quote-block',
		'testimonials-block',
		'card-block',
		'table-block',
		'product-block',
		'team-block',
		'section-title-block',
		'nap-block',
		'form-block'
	);

	foreach ( $blocks as $block ) {
		register_block_type( get_stylesheet_directory() . '/templates/blocks/'.$block.'/block.json' );
	}
}
