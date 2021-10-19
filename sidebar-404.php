<?php

/**
 *  Сайдбар сторынки 404
 */


echo "<aside class=\"main__aside aside\" id=\"main-aside\">";
if ( is_active_sidebar( 'side_404' ) ) {
  dynamic_sidebar( 'side_404' );
} else {
  $search_widget_intance = array(
    'title'           => __( 'Знайти', 'events-theme' ),
  );
  $search_widget_args = array(
    'before_widget'   => '<div class="widget">',
    'after_widget'    => '</div></div>',
    'before_title'    => '<h3 class="widget__title">',
    'after_title'     => '</h3><div class="widget__body">'
  );
  the_widget( 'WP_Widget_Search', $search_widget_intance, $search_widget_args );
}
echo "</aside>";

?>