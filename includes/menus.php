<?php

/**
 *	Регистрация меню
 */

add_action( 'after_setup_theme', function () {

	register_nav_menus( array(
		'header_left_menu'			=> __( 'Меню в шапці (зліва)', 'pstu-events' ),
		'header_right_menu'			=> __( 'Меню в шапке (зправа)', 'pstu-events' ),
		'footer_menu'						=> __( 'Меню в підвалі', 'pstu-events' ),
	) );

} );


// изменяем название стандартных классов меню
// add_filter( 'nav_menu_css_class' , function ( $classes, $item ) {
// 	echo "<pre>";
// 	var_dump( $item );
// 	echo "</pre>";
// } , 10 , 2 );

