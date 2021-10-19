<?php

/**
 *	Библиотека функций
 */


if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Обрабатывает чекбокс перед сохранением
 * @return bool           
 */
function events_sanitize_checkbox( $checked ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


// получаем количество просмотров
if ( ! function_exists( 'get_post_views' ) ) {
	function get_post_views( $postID ) {
		$count = get_post_meta( $postID, '_post_views_count', true );
		$count = ( empty( $count ) ) ? set_post_views( $postID ) : $count++;
		return $count;
	}
}



// выводим количество просмотров
if ( ! function_exists( 'the_post_views' ) ) {
	function the_post_views( $postID ) {
		echo get_post_views( $postID );
		return true;
	}
}



// устанавливаем
if ( ! function_exists( 'set_post_views' ) ) {
	function set_post_views( $postID ) {
		$count = get_post_meta( $postID, '_post_views_count', true );
		$count = ( empty( $count ) ) ? '1' : ( (int)$count + 1 );
		update_post_meta( $postID, '_post_views_count', $count );
		return $count;
	}
}



// Хлебные крошки
if ( ! function_exists( 'the_breadcrumb' ) ) {
	function the_breadcrumb() {
		if ( function_exists( 'bcn_display' ) ) {
			bcn_display();
		} else {
			if ( is_404() ) {
				echo "<li><a href=\"" . home_url() . "\">" . __( 'Повернутись на головну сторінку', 'events-theme' ) . "</a></li>";
				return;
			}
			if ( ! is_front_page() ) {
				echo "<li><a href=\"" . home_url() . "\">" . __( 'Головна', 'events-theme' ) . "</a></li>";
				if ( is_category() || is_single() ) {
					echo "<li>";
					the_category( ' ' );
					echo "</li>";
					if ( is_single() ) {
						echo "<li class=\"active\">" . get_the_title() . "</li>";
					}
				} elseif ( is_page() ) {
					echo "<li class=\"active\">" . get_the_title() . "</li>";
				}
			}
			else {
					echo "<li class=\"active\">" . __( 'Домашня сторінка', 'events-theme' ) . "</li>";
			}
		}
	}
}




if ( ! function_exists( 'bootstrap_pagination' ) ) {
	function bootstrap_pagination( $echo = true ) {
		global $wp_query;
		$big = 999999999;
		$pages = paginate_links( array(
				'base'					=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'				=> '?paged=%#%',
				'current'				=> max( 1, get_query_var('paged') ),
				'total'					=> $wp_query->max_num_pages,
				'type'					=> 'array',
				'prev_next'			=> true,
				'prev_text'			=> '« ' . __( 'Попередня сторінка', 'events-theme' ),
				'next_text'			=> __( 'Наступна сторінка', 'events-theme' ) . ' »',
			)
		);
		if( is_array( $pages ) ) {
			$paged = ( get_query_var( 'paged') == 0 ) ? 1 : get_query_var( 'paged' );
			$pagination = '<ul class="pagination">';
			foreach ( $pages as $page ) {
				$pagination .= "<li>" . $page . "</li>";
			}
			$pagination .= '</ul>';
			if ( $echo ) {
				echo $pagination;
			} else {
				return $pagination;
			}
		} // for
	} // bootstrap_pagination
}




/**
 *	Определение IP пользователя
 */
if ( ! function_exists( 'get_the_user_ip' ) ) {
	function get_the_user_ip() {
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			//check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return apply_filters( 'edd_get_ip', $ip );
	}
}