<?php

/**
 *	Метабокс для страницы с шаблоном "Контакты"
 *	Метаданные:
 *	- адрес
 *	- src карты
 *	- шорткод формы контактов
 */

if ( ! defined( 'ABSPATH' ) ) {	exit; };

function call_eventsThemeContactMetaboxClass() {
	new eventsThemeContactMetaboxClass();
}


if ( is_admin() ) {
	add_action( 'load-post.php',				'call_eventsThemeContactMetaboxClass' );
	add_action( 'load-post-new.php',		'call_eventsThemeContactMetaboxClass' );
}



class eventsThemeContactMetaboxClass {



	/**
	 *	Создание класса / добавление хуков для вывода метабокса
	 */
	public function __construct() {
		add_action( 'add_meta_boxes',			array( $this, 'add_meta_box' ) );
		add_action( 'save_post',					array( $this, 'save' ) );
	}


	/**
	 *	Регистрация метабокса
	 */
	public function add_meta_box( $post_type ) {
		// Устанавливаем типы постов к которым будет добавлен блок
		$post_types = array( 'page' );
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'events_theme_contact_metabox',												// id атрибут HTML тега, контейнера блока
				__( 'Контакти', 'events-theme' ),											// заголовок/название блока. Виден пользователям
				array( $this, 'render_metabox_content' ),							// Функция, которая выводит на экран HTML содержание блока
				$post_type,																						// для каких типов / экранов добавляемя сетабокс
				'advanced',																						// Место где должен показываться блок: normal, advanced или side
				'high',																								// Приоритет блока для показа выше или ниже остальных блоков: high или low
				null																									// Аргументы, которые нужно передать в callback функцию
			);
		}
	}


	/**
	 *	Получение id с переводом
	 */
	static function get_translation_id( $post_id=false ) {

		$post_id = ( $post_id ) ? $post_id : get_the_ID();

		$result = $post_id;

		// проверяем работает ли плагин переводов
		if ( defined( "POLYLANG_FILE" ) ) {

			$result = ( isset( $_GET[ 'from_post' ] ) ) ? $_GET[ 'from_post' ] : $result;

		}

		return $result;
	}


	/**
	 *	Метаданные
	 */
	static function get_params( $key = 'parent_items' ) {

		$result = array();

		switch ( $key ) {

			case 'parent_items':
			default:
				$result = array(
					'address'					=> __( 'Адреса организації',			'events-theme' ),
					'map'							=> __( 'Код Google-мапи',					'events-theme' ),
					'form'						=> __( 'Шорткод форми',						'events-theme' ),
				);
				break;

		}

		return $result;

	} // get_params



	/**
	 *	Получание и проверка метаполей
	 */
	static function get_meta( $post_id = false ) {

		$post_id = ( $post_id ) ? $post_id : get_the_ID();

		$post_meta = array();

		foreach ( eventsThemeContactMetaboxClass::get_params() as $key => $label ) {

			switch ( $key ) {

				case 'address':
				case 'map':
				case 'form':
					$meta = get_post_meta( $post_id, '_events_theme_' . $key, true );
					$post_meta[ $key ] = ( isset( $meta ) ) ? $meta : '';
					break;
				
				default: break;
			} // switch
		
		} // foreach

		return $post_meta;

	} // get_meta



	/**
	 *	Проверка и сохранение данных
	 */
	public function save( $post_id ) {

		// проверяем существует ли nonce-поле, если нет - выходим
		if ( ! isset( $_POST[ 'events_contact_metabox_nonce' ] ) ) {
			// wp_nonce_ays();
			return;
		}

		// проверяем значение nonce-поля, если не совпадает - выходим
		if ( ! wp_verify_nonce( $_POST[ 'events_contact_metabox_nonce' ], 'events_contacts_metabox' ) ) {
			wp_nonce_ays();
			return;
		}

		// исключаем автосохранение и ревизии
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( wp_is_post_revision( $post_id ) ) return;	

		// проверяем права пользователя
		if ( 'page' == $_POST[ 'post_type' ] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;
		} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
			wp_nonce_ays();
			return;
		}

		foreach ( $this->get_params() as $key => $label ) {
			
			switch ( $key ) {

				case 'map':
					if ( isset( $_POST[ $key ] ) ) {
						update_post_meta( $post_id, '_events_theme_' . $key, esc_textarea( $_POST[ $key ] ) );
					} else {
						delete_post_meta( $post_id, '_events_theme_' . $key );
					}
					break;

				case 'address':
				case 'form':
					if ( isset( $_POST[ $key ] ) ) {
						update_post_meta( $post_id, '_events_theme_' . $key, sanitize_text_field( $_POST[ $key ] ) );
					} else {
						delete_post_meta( $post_id, '_events_theme_' . $key );
					}
					break;
				
				default: break;
			} // switch

		} // foreach

	} // save



	/**
	 *	Вывод метабокса
	 */
	public function render_metabox_content( $post ) {

		// получаем метаданые
		$meta = $this->get_meta( $this->get_translation_id( $post->ID ) );

		$result = "";

		// Добавляем nonce поле, которое будем проверять при сохранении.
		$result .= wp_nonce_field( 'events_contacts_metabox', 'events_contact_metabox_nonce', true, false );

		// выводим форму
		$result .= "<div class=\"pstu_wrap\">\r\n";

		$result .= "<div class=\"well\">";
		$result .= "<div>" . __( 'Використовується тільки на сторінках з шаблоном "Контакти".', 'events-theme' ) . "</div>\r\n";
		$result .= "</div>\r\n"; // .well

		$result .= "<div class=\"panel panel-info\">";
		$result .= "<div class=\"panel-heading\">FAQ</div>";
		$result .= "<div class=\"panel-body\">";
		$result .= "";
		$result .= "";
		$result .= "";
		$result .= "</div>"; // .panel

		// получаем перевод если есть
		$translation_id = $this->get_translation_id( $post->ID );


		foreach ( $this->get_params() as $key => $label ) {
			switch ( $key ) {

				case 'map':
					$result .= "<div class=\"form-group\">";
					$result .= "<div class=\"row\">";
					$result .= "<div class=\"col-sm-3\">";
					$result .= "<label for=\"events-theme-" . $key . "\">" . $label . "</label>";
					$result .= "</div>"; // .col-sm-4
					$result .= "<div class=\"col-sm-9\">";
					$result .= "<textarea id=\"events-theme-" . $key . "\" name=\"" . $key . "\" placeholder=\"\" class=\"form-control\">" . wp_specialchars_decode( $meta[ $key ] ) . "</textarea>";
					$result .= "</div>"; // .col-sm-8
					$result .= "</div>"; // .row
					$result .= "</div>"; // .form-group
					break;

				case 'address':
				case 'form':
				default:
					$result .= "<div class=\"form-group\">";
					$result .= "<div class=\"row\">";
					$result .= "<div class=\"col-sm-3\">";
					$result .= "<label for=\"events-theme-" . $key . "\">" . $label . "</label>";
					$result .= "</div>"; // .col-sm-4
					$result .= "<div class=\"col-sm-9\">";
					$result .= "<input type=\"text\" id=\"events-theme-" . $key . "\" name=\"" . $key . "\" placeholder=\"\" class=\"form-control\" value=\"" . $meta[ $key ] . "\">";
					$result .= "</div>"; // .col-sm-8
					$result .= "</div>"; // .row
					$result .= "</div>"; // .form-group
					break;

			}
		}


		$result .= "</div>\r\n"; // .pstu_wrap

		echo $result;

	}

}