<!-- комментарии-->
<div class="comments" id="comments">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <h3 class="panel-title pull-left"><?php _e( 'Коментарі:', 'events-theme' ); ?></h3>
      <div class="pull-right"><?php printf( "%s %d", __( 'Всьго:', 'events-theme' ), get_comments_number( get_the_ID() ) ); ?></div>
    </div>
    <div class="panel-body"> <?php

      /**
       *  Выводим список комментариев
       */

      if ( ! function_exists( 'events_theme_comment' ) ) {
        function events_theme_comment( $comment, $args, $depth ) {
          $GLOBALS['comment'] = $comment;
          $result = "";
          $result .= "<div class=\"" . implode( ' ', get_comment_class( array( 'media', 'comment' ), $comment->comment_ID, get_the_ID() ) ) . "\" id=\"comment-" . $comment->comment_ID . "\">";

          $result .= "<div class=\"media-left\">";
          $result .= "<img class=\"media-object comment__foto hidden-xs\" src=\"" . get_avatar_url( $comment, array( 'size' => 64, 'default' => EVENTS_THEME_URL . '/images/user-xs.png' ) ) . "\" alt=\"" . get_comment_author() . "\">";
          $result .= "</div>"; // media-left

          $result .= "<div class=\"media-body\">";
          $result .= "<h4 class=\"media-heading\">" . get_comment_author_link() . "</h4>";
          if ($comment->comment_approved == '0') $result .= "<div class=\"alert alert-warning small\" role=\"alert\">" . __( 'Ваш коментар очікує на перевірку', 'pstu-theme' ) . "</div>";
          $result .= "<p>" . get_comment_text() . "</p>";
          $result .= "<div class=\"clearfix\">";
          $result .= "<date class=\"small pull-left text-info\">" . get_comment_date( 'd-m-Y' ) . " " . get_comment_time( 'H:i' ) . "</date>";
          if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) {
            $result .= "<span  class=\"pull-right\"><a href=\"" . get_edit_comment_link() . "\" role=\"button\"><i class=\"glyphicon glyphicon-pencil\"></i> " . __( 'Редагувати', 'events-theme' ) . "</a></span>";
          }
          $reply_link_args = array(
            'reply_text'    => '<i class=\"glyphicon glyphicon-share-alt\"></i> ' . __( 'Відповісти', 'events-theme' ),   // Текст ссылки
            'login_text'    => __( 'Авторізуйтесь для відповіді', 'events-theme' ),
            'depth'         => 2,
            'before'        => '<span class=\"pull-right\">',
            'after'         => '</span>',
            'respond_id'    => 'comment-form',
          );
          $result .= ( $reply_link = get_comment_reply_link( $reply_link_args, $comment->comment_ID, get_the_ID() ) ) ? $reply_link : '';
          $result .= "</div>"; // .clearfix
          $result .= "";
          echo $result;
        }
      }


      if ( ! function_exists( 'events_theme_comment_end' ) ) {
        function events_theme_comment_end() {
          $result = "";
          $result .= "</div>"; // .media .comment
          $result .= "</div>"; // .media-body
          echo $result;
        }
      }
        



      $count_comment = wp_count_comments( get_the_ID() );
        $comments_args = array(
          'walker'              => null,
          'max_depth'           => '2',
          'style'               => 'div',
          'callback'            => 'events_theme_comment',
          'end-callback'        => 'events_theme_comment_end',
          'type'                => 'all',
          'reply_text'          => __( 'Відповісти', 'events-theme' ),
          'avatar_size'         => 64,
          'reverse_top_level'   => null,
          'reverse_children'    => false,
          'format'              => 'html5', // или xhtml, если HTML5 не поддерживается темой
          'short_ping'          => false,    // С версии 3.6,
          'echo'                => true,     // true или false
        );

        echo "<div class=\"comments__list media-list commentlist\">";
        wp_list_comments( $comments_args );
        echo "</div>"; // media-list

        echo "<div class=\"clearfix\">" . get_the_comments_pagination() . "</div>";


        /**
         *  Выводим форму комментариев
         */

        $commenter = wp_get_current_commenter();

        $comment_form_arg = array(
          'fields'               => array(
            'author'  =>  '<div class="row"><div class="col-sm-4"><div class="form-group"><label for="comment-user">' . __( 'Ваше ім\'я', 'events-theme' ) . '</label><div class="input-group"><span class="input-group-addon" id="comment-addon-user"><i class="glyphicon glyphicon-user"></i></span><input class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" id="author" name="author" type="text" size="30" placeholder="Name" aria-describedby="comment-addon-user"></div></div></div>',
            'email'   =>  '<div class="col-sm-4"><div class="form-group"><label for="comment-email">' . __( 'Ваш email', 'events-theme' ) . '</label><div class="input-group"><span class="input-group-addon" id="comment-addon-email"><i class="glyphicon glyphicon-envelope"></i></span><input class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) . '" id="email" name="email" type="text" size="30" placeholder="email@example.com" aria-describedby="comment-addon-email"></div></div></div>',
            'url'     =>  '<div class="col-sm-4"><div class="form-group"><label for="comment-url">' . __( 'Ваш сайт', 'events-theme' ) . '</label><div class="input-group"><span class="input-group-addon" id="comment-addon-url"><i class="glyphicon glyphicon-globe"></i></span><input class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) . '" id="url" name="url" type="text" size="30" placeholder="http://example.com" aria-describedby="comment-addon-url"></div></div></div>',
          ),
          'comment_field'        => '<div class="row"><div class="col-xs-12"><div class="form-group"><label for="contacts-msg"><i class="glyphicon glyphicon-text-size"></i> ' . __( 'Коментар:', 'events-theme' ) . '</label><textarea class="form-control" required="required" id="comment-msg" name="comment" placeholder="remark, observation, statement, utterance, pronouncement, judgement, reflection, opinion, view, criticism"></textarea></div></div></div>',
          'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'Вам необхідно <a href="%s">авторизуватись</a> щоб залишити коментар.', 'events-theme' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
          'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( '<a href="%1$s" aria-label="Ви авторизувались як %2$s. Редагувати свій профіль.">Ви авторизувались як %2$s</a>. <a href="%3$s">Вийти?</a>', 'events-theme' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
          'comment_notes_before' => '<p>' . __( 'Ваш e-mail адрес не публикуется.', 'events-theme' ) . '</p>',
          'comment_notes_after'  => '',
          'id_form'              => 'comment-form',
          'id_submit'            => 'comment-form-submit',
          'class_form'           => 'comment__form form',
          'class_submit'         => 'btn btn-block btn-success',
          'name_submit'          => '',
          'title_reply'          => __( 'Залишити відповідь', 'events-theme' ),
          'title_reply_to'       => __( 'Залишити відповідь для to %s', 'events-theme' ),
          'title_reply_before'   => '<h4>',
          'title_reply_after'    => '</h4>',
          'cancel_reply_before'  => '<small>',
          'cancel_reply_after'   => '</small>',
          'cancel_reply_link'    => __( 'Відмінити відповідь', 'events-theme' ),
          'label_submit'         => __( 'Залишити коментар', 'events-theme' ),
          'submit_button'        => '<button id="%2$s" class="%3$s" role="submit"><i class="glyphicon glyphicon-send"></i> %4$s</button>',
          'submit_field'         => '<div class="row"><div class="col-xs-12">%1$s %2$s</div></div>',
          'format'               => 'xhtml',
        );
        comment_form( $comment_form_arg ); ?>
      
    </div>
  </div>
</div>
<!---->
<!-- end комментарии-->

