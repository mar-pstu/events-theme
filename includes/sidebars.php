<?php

/**
 *	Регистрация сайдбаров
 */

add_action( 'widgets_init', function () {

	register_sidebar( array(
		'name'						=> __( 'Сайдбар шапки', 'events-theme' ),
		'id'							=> 'side_jumbotron',
		'description'			=> __( 'Відображається тільки на головній сторінці сайту.', 'events-theme' ),
		'class'						=> '',
		'before_widget'		=> '<div class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3 class="widget__title">',
		'after_title'			=> '</h3>',
	) );

	register_sidebar( array(
		'name'						=> __( 'Права Колонка', 'events-theme' ),
		'id'							=> 'side_right',
		'description'			=> __( 'Права колонка. Відображається на всіх сторінках сайту.', 'events-theme' ),
		'class'						=> '',
		'before_widget'		=> '<div class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3 class="widget__title">',
		'after_title'			=> '</h3>',
	) );

	register_sidebar( array(
		'name'						=> __( 'Сайдбар футера', 'events-theme' ),
		'id'							=> 'side_footer',
		'description'			=> __( 'Відображається на всіх сторінках внизу сайта.', 'events-theme' ),
		'class'						=> '',
		'before_widget'		=> '<div class="col-sm-3"><div class="widget">',
		'after_widget'		=> '</div></div>',
		'before_title'		=> '<h3 class="widget__title">',
		'after_title'			=> '</h3>',
	) );

	register_sidebar( array(
		'name'						=> __( 'Сайдбар 404', 'events-theme' ),
		'id'							=> 'side_404',
		'description'			=> __( 'Відображається на сторінці 404', 'events-theme' ),
		'class'						=> '',
		'before_widget'		=> '<div class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3 class="widget__title">',
		'after_title'			=> '</h3>',
	) );

	register_sidebar( array(
		'name'						=> __( 'Контакти', 'events-theme' ),
		'id'							=> 'side_contacts',
		'description'			=> __( 'Відображається лише на сторінках з шаблоном "Контакти".', 'events-theme' ),
		'class'						=> '',
		'before_widget'		=> '<div class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h3 class="widget__title">',
		'after_title'			=> '</h3>',
	) );

} );