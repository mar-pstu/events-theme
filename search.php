<?php get_header(); ?>

<div class="row">
  <div class="<?php echo ( is_active_sidebar( 'side_right' ) ) ? 'col-sm-8' : 'col-xs-12'; ?>"> <?php

    if ( have_posts() ) {


      echo "<ul class=\"search__list list\">";

      while ( have_posts() ) {

        the_post();

        echo "<li class=\"item clearfix\">";
        echo "<h4>" . get_the_title() . "</h4>";
        echo "<p class=\"small\">" . get_the_excerpt() . "</p>";
        echo "<div class=\"clearfix\">";
        if ( ! empty( $tags_list = get_the_tag_list( "<ul class=\"tags__list list\"><li><i class=\"glyphicon glyphicon-tag\"></i> ", "</li><li><i class=\"glyphicon glyphicon-tag\"></i> ", "</li></ul>") ) ) {
          echo "<div class=\"pull-left tags\">";
          echo "<dd><div class=\"tags\">" . $tags_list . "</div></dd>";
          echo "</div>"; // tags
        }
        echo "<ul class=\"list-inline text-right\">";
        echo "<li><i class=\"glyphicon glyphicon-user\"></i> " . __( 'Автор', 'events-theme' ) . ": " . the_author() . "</li>";
        echo "<li><i class=\"glyphicon glyphicon-calendar\"></i> " . get_the_modified_date( 'Y/m/d' ) . "</li>";
        echo "<li><a href=\"" . get_the_permalink() . "\">" . __( 'Докладніше', 'events-theme' ) . " <i class=\"glyphicon glyphicon-menu-right\"></i></a></li>";
        echo "</ul>";
        echo "</div>"; // .clearfix
        echo "</li>";

      }

      echo "</ul>";

    } else {
      echo "<h2 class=\"text-info\">" . __( 'Нажаль матеріали не знайдені.', 'events-theme' ) . "</h2>";
    } ?>
  </div> <!-- .col- -->

<?php get_sidebar( 'right' ); ?>

</div> <!-- .row -->

<?php get_footer(); ?>