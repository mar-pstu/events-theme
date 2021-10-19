<?php


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 *	Список в виде аккордеона
 */


function get_accordio_list( $atts, $content, $shortcode_name ) {
	$atts = shortcode_atts( array(
		'headers'   => 'h2',
		'style'     => 'primary'
	), $atts, $shortcode_name );
	return force_balance_tags( sprintf(
		'<div class="accordio is-style-accordio-%3$s" data-heading="%1$s" data-build="1">%2$s</div>',
		esc_attr( $atts[ 'headers' ] ),
		do_shortcode( $content ),
		$atts[ 'style' ]
	) );

}

add_shortcode( 'accordio_list', 'get_accordio_list' );
add_shortcode( strtoupper( 'accordio_list' ), 'get_accordio_list' );
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop', 12 );