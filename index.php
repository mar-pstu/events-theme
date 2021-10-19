<?php get_header(); ?>

<div class="row">
  <div class="<?php echo ( is_active_sidebar( 'side_right' ) ) ? 'col-sm-8' : 'col-xs-12'; ?>"> <?php

    if ( is_category() ) {
      if ( ! empty( $category_description = category_description() ) ) echo "<div class=\"well\">" . $category_description . "</div>";
    } elseif ( is_tag() ) {
      if ( ! empty( $tag_description = tag_description() ) ) echo "<div class=\"well\">" . $tag_description . "</div>";
    } elseif ( is_archive() ) {
      if ( ! empty( $archive_description = get_the_archive_description() ) ) echo "<div class=\"well\">" . $archive_description . "</div>";
    }

    /**
     *  Вывод поостов
     */

    if ( have_posts() ) {

      // получение размера постов
      switch ( get_theme_mod( 'post_size', 'sm' ) ) {

        case 'md':
          for ( $i=0; have_posts(); $i++ ) {
            the_post();
            $post_thumb = get_the_post_thumbnail_url( $post->ID, 'large' );
            echo "<div class=\"post-md\">";
            if ( $post_thumb ) echo "<img class=\"thumbnail img-responsive\" src=\"" . $post_thumb . "\" alt=\"" . get_the_title() . "\">";
            echo "<h3>" . get_the_title() . "</h3>";
            echo "<div class=\"clearfix\">";
            echo "<ul class=\"pull-left list-inline small\">";
              echo "<li><i class=\"glyphicon glyphicon-user\"></i> admin</li>";
              echo "<li><i class=\"glyphicon glyphicon-calendar\"></i> " . get_the_date() . "</li>";
              echo "<li><i class=\"glyphicon glyphicon-eye-open\"></i> " . get_post_views( $post->ID ) . "</li>";
              echo "<li><i class=\"glyphicon glyphicon-comment\"></i> " . get_comments_number( '0', '1', '%' ) . "</li>";
            echo "</ul>";
            if ( ! empty( $tags_list = get_the_tag_list( "<ul class=\"tags__list list\"><li><i class=\"glyphicon glyphicon-tag\"></i> ", "</li><li><i class=\"glyphicon glyphicon-tag\"></i> ", "</li></ul>") ) ) {
              echo "<div class=\"pull-right tags small\">";
              echo "<dd><div class=\"tags\">" . $tags_list . "</div></dd>";
              echo "</div>"; // tags
            }
            echo "</div>"; // clearfix
            echo "<p class=\"excerpt\">" . get_the_excerpt() . "</p>";
            echo "<div class=\"text-right\">";
            echo "<a class=\"btn btn-primary\" href=\"" . get_the_permalink() . "\" role=\"button\">";
            echo "<i class=\"glyphicon glyphicon-link\"></i> " . __( 'Докладніше', 'events-theme' );
            echo "</a>"; // btn
            echo "</div>"; // text-right
            echo "<hr>";
            echo "</div>"; // post-md
          }
          break;
        
        case 'sm':
        default:
          echo "<div class=\"row\">";
          for ( $i=0; have_posts(); $i++ ) {
            the_post();
            $post_thumb = get_the_post_thumbnail_url( $post->ID, 'small' );
            $post_thumb = ( $post_thumb ) ? $post_thumb : EVENTS_THEME_URL . 'images/thumbnail-sm-1.jpg';
            echo "<div class=\"col-sm-6 col-lg-4\">";
            echo "<div class=\"thumbnail\">";
            echo "<img src=\"" . $post_thumb . "\" alt=\"" . get_the_title() . "\">";
            echo "<div class=\"caption\">";
              echo "<h3>" . get_the_title() . "</h3>";
              echo "<p class=\"excerpt\">" . get_the_excerpt() . "</p>";
              echo "<div class=\"text-right\">";
              echo "<a class=\"btn btn-block btn-primary\" href=\"" . get_the_permalink() . "\" role=\"button\">";
              echo "<i class=\"glyphicon glyphicon-link\"></i> " . __( 'Докладніше', 'events-theme' );
              echo "</a>"; // btn
              echo "</div>"; // text-right
            echo "</div>"; // caption
            echo "</div>"; // thumbnail
            echo "</div>"; // col-sm-6 col-md-4
          } 
          echo "</div>"; // row
          break;

      } // switch

      if ( function_exists( 'bootstrap_pagination' ) ) {
        echo "<nav class=\"text-center\" aria-label=\"" . __( 'Навігація сторінок', 'events-theme' ) . "\">";
        bootstrap_pagination();
        echo "</nav>";
      } else {
        echo "<div class=\"text-center\">";
        $pagination_args = array(
          'show_all'        => false, // показаны все страницы участвующие в пагинации
          'end_size'        => 1,     // количество страниц на концах
          'mid_size'        => 1,     // количество страниц вокруг текущей
          'prev_next'       => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
          'prev_text'       => '« ' . __( 'Попередня сторінка', 'events-theme' ),
          'next_text'       => __( 'Наступна сторінка', 'events-theme' ) . ' »',
          'add_args'        => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
          'add_fragment'    => '',     // Текст который добавиться ко всем ссылкам.
          'screen_reader_text' => __( 'Навігація постів', 'events-theme' ),
        );
        the_posts_pagination( $pagination_args );
        echo "</div>";
      }

    } else {
      echo "<h3 class=\"text-info\">" . __( 'Нажаль матеріали не знайдені.', 'events-theme' ) . "</h3>";
    } ?>
  </div> <!-- .col- -->

<?php get_sidebar( 'right' ); ?>

</div> <!-- .row -->

<?php get_footer(); ?>