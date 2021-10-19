<?php


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Выводит блок для "очистки потока"
 * @return    string    html код
 */
function get_tabs_block( $atts, $content, $shortcode_name ) {
	$atts = shortcode_atts( array(
		'headers'	=> 'h2',
	), $atts, $shortcode_name );
	return force_balance_tags( sprintf(
		'<div class="tabs" data-heading="%1$s">%2$s</div><!-- .tabs -->',
		esc_attr( $atts[ 'headers' ] ),
		do_shortcode( $content )
	) );
}


add_shortcode( 'tabs', 'get_tabs_block' );
add_shortcode( strtoupper( 'tabs' ), 'get_tabs_block' );