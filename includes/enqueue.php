<?php

/**
 *	Регистрация и подключение стилей и скриптов
 */


// добавление критикал стилей и скриптов
add_action( 'wp_head', function () {
	echo "<style type=\"text/css\">" . file_get_contents(  EVENTS_THEME_DIR . 'css/critical.css' ) . "</style>\r\n";	
} );



// подключение стилей к редактору
add_action( 'current_screen', function () {
	add_editor_style( EVENTS_THEME_URL . 'css/bootstrap-orange.min.css' );
	add_editor_style( EVENTS_THEME_URL . 'css/main.css' );
} );



// загрузка остальных
add_action( 'wp_enqueue_scripts', function () {

	// подключение кастомизированных стилей bootstrap 3
	wp_enqueue_style(
		'bootstrap',
		EVENTS_THEME_URL . 'css/bootstrap-orange.min.css',
		array(),
		'3.3.7'
	);

	// подключение шрифтов
	wp_enqueue_style(
		'pt-sans',
		'https://fonts.googleapis.com/css?family=PT+Sans',
		array(),
		null
	);

	// 
	wp_enqueue_style(
		'events-main',
		EVENTS_THEME_URL . 'css/main.css',
		array(),
		filemtime( EVENTS_THEME_DIR . 'css/main.min.css' )
	);

	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery',
			EVENTS_THEME_URL . 'scripts/jquery.min.js',
			null,
			null,
			'in_footer'
		);
	}

	// паралакс для главной страницы
	if ( is_front_page() ) {
		wp_enqueue_script(
			'parallax',
			EVENTS_THEME_URL . 'scripts/parallax.min.js',
			array( 'jquery' ),
			null,
			false
		);
	}

	// скрипты bootstrap
	wp_enqueue_script(
		'bootstrap',
		EVENTS_THEME_URL . 'scripts/bootstrap.min.js',
		array( 'jquery' ),
		'3.3.7',
		'in_footer'
	);

	// скрипты для работы комментариев
	wp_enqueue_script( 'comment-reply' );

	// скрипты для баянов
	wp_enqueue_script(
		'accordio-shortcode',
		get_theme_file_uri( 'scripts/accordio.js' ),
		array( 'jquery' ),
		filemtime( get_theme_file_path( 'scripts/accordio.js' ) ),
		'in_footer'
	);

	// скрипты для табов
	wp_enqueue_script(
		'tabs-shortcode',
		get_theme_file_uri( 'scripts/tabs.js' ),
		array( 'jquery' ),
		filemtime( get_theme_file_path( 'scripts/tabs.js' ) ),
		'in_footer'
	);

} );



add_action( 'customize_preview_init', function () {
	wp_enqueue_script(
		'customizerwert',
		EVENTS_THEME_URL . 'scripts/customizer.js',
		array( 'jquery', 'customize-preview' ),
		filemtime( EVENTS_THEME_DIR . 'scripts/customizer.js' ),
		'in_footer'
	);

} );



// подключение стилей в админку
add_action( 'admin_print_styles', function () {

	if ( ! wp_style_is( 'pstu-backend' ) ) {
		wp_enqueue_style(
			'pstu-backend',
			EVENTS_THEME_URL . 'css/backend.css',
			array(),
			filemtime( EVENTS_THEME_DIR . 'css/backend.css' )
		); /**/
	}

} );



// подключение скриптов в админку
add_action( 'admin_enqueue_scripts', function () {

	if ( ! wp_script_is( 'bootstrap' ) ) {
		wp_enqueue_script(
			'bootstrap',
			EVENTS_THEME_URL . 'scripts/bootstrap.js',
			array( 'jquery' ),
			'3.3.7',
			'in_footer'
		); /**/
	}

} );