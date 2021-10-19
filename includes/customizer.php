<?php

/**
 *	Регистрация настроек темы
 */

add_action( 'customize_register', function ( $wp_customize ) {

	// Регистрация панели "Настройки темы""
	$wp_customize->add_panel(
		'events_theme_options',
		array(
			'capability'	=> 'edit_theme_options',
			'title'				=> __( 'Налаштування теми "Events PSTU"', 'events-theme' ),
			'priority'		=> 200
		)
	);


	$wp_customize->add_setting(
		'post_size',
		array(
			'default'            => 'sm',
			'transport'          => 'reset'
		)
	);
	$wp_customize->add_control(
		'post_size',
		array(
			'section'  => 'static_front_page',
			'label'    => __( 'Вібир розміру постів головної сторінки', 'events-theme' ),
			'type'     => 'select',
			'choices'  => array(
				'sm'				=> __( 'SM', 'events-theme' ),
				'md'				=> __( 'MD', 'events-theme' ),
			),
		)
	); /**/


	// регистрация секции и  настроект "404" ( шорткод формы обратной связи, рисунок-превью, текст заголовка, текст подзаголовка )
	$wp_customize->add_section(
		'events_404',
		array(
			'title'       => __( 'Сторінка 404', 'events-theme' ),
			'priority'    => 10,
			'description' => __( 'Налаштування сторінки помилки 404 (404.php)' , 'events-theme' ),
			'panel'       => 'events_theme_options'
		)
	); /**/

	$wp_customize->add_setting(
		'title_404',
		array(
			'default'            => __( 'Запитувана вами сторінка не знайдена', 'events-theme' ),
			'transport'          => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'title_404',
		array(
			'section'  => 'events_404',
			'label'    => __( 'Заголовок', 'events-theme' ),
			'type'     => 'text',
		)
	); /**/

	$wp_customize->add_setting(
		'subtitle_404',
		array(
			'default'            => __( 'На жаль такої сторінки не існує. Імовірно, вона була видалена, або її тут ніколи не було. Ви можете скористатися пошуком або зв\'язатися з адміністрацією сайту.', 'events-theme' ),
			'transport'          => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'subtitle_404',
		array(
			'section'  => 'events_404',
			'label'    => __( 'Заголовок', 'events-theme' ),
			'type'     => 'text',
		)
	); /**/


	// регистрация секции для настроек шапки сайта
	$wp_customize->add_section(
		'theme_header',
		array(
			'title'       => __( 'Шапка сайту', 'events-theme' ),
			'priority'    => 10,
			'description' => __( 'Налаштування шапки сайту (header.php)' , 'events-theme' ),
			'panel'       => 'events_theme_options'
		)
	); /**/

	$wp_customize->add_setting(
		'header_share_flag',
		array(
			'default'           => false,
			'transport'         => 'reset',
			'sanitize_callback' => 'events_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'header_share_flag',
		array(
			'section'           => 'theme_header',
			'label'             => __( 'Вікористовувати Yandex.share', VSTUP_TEXTDOMAIN ),
			'type'              => 'checkbox',
		)
	); /**/

	

}, 10, 1 );