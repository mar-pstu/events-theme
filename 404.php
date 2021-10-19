<?php get_header() ?>
<div class="row">
  <div class="col-sm-6">
    <img class="error404__logo img-responsive" src="<?php echo EVENTS_THEME_URL . '/images/error-404-orange.png'; ?>" alt="<?php _e( 'Ошибка 404', 'events-theme' ) ?>">
    <h2 id="title_404"><?php echo get_theme_mod( 'title_404', __( 'Запитувана вами сторінка не знайдена', 'events-theme' ) ); ?></h2>
    <p id="subtitle_404"><?php echo get_theme_mod( 'subtitle_404', __( 'На жаль такої сторінки не існує. Імовірно, вона була видалена, або її тут ніколи не було. Ви можете скористатися пошуком або зв\'язатися з адміністрацією сайту.', 'events-theme' ) ); ?></p> <?php

    /**
     *  Обработка формы страницы 404
     */

    if ( isset( $_POST[ 'msg' ] ) ) {

      $fields = array(
        'username'  => __( 'Від кого',          'events-theme' ),
        'email'     => __( 'Email',             'events-theme' ),
        'phone'     => __( 'Телефон',           'events-theme' ),
        'url'       => __( 'URL сторінки',      'events-theme' ),
        'msg'       => __( 'Повідомлення',      'events-theme' ),
      );

      // проверка по стандартному черном списку
      $blacklist_check = wp_blacklist_check( 
        sanitize_text_field( trim( $_POST[ 'username' ] ) ) ,
        sanitize_text_field( trim( $_POST[ 'email' ] ) ) ,
        '',
        sanitize_textarea_field( trim( $_POST[ 'msg' ] ) ),
        ( function_exists( 'get_the_user_ip' ) ) ? get_the_user_ip() : '',
        ''
      );
      if ( $blacklist_check ) {
        echo '<div class="alert alert-danger">'. __( 'Повідомлення не пройшло перевірку!', 'events-theme' ) . '</div>';
        exit;
      }

      // формируем сообщение
      $msg = "";

      $msg .= "<table class=\"table\" style=\"width: 100%;\">\r\n";

      foreach ( $fields as $key => $value ) {

        $msg .= "<tr>\r\n";
        $msg .= "<td width=\"25%\">" . $value . "</td>\r\n";
        $msg .= "<td>\r\n";

        switch ( $key ) {

          case 'msg':
            $msg .= "<pre><font size=\"3\">" . sanitize_textarea_field( trim( $_POST[ $key ] ) ) . "</font></pre>\r\n";
            break;

          case 'url':
            $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
            if ( ! empty( $url ) ) $msg .= "<a href=\"" . $url . "\">" . $url . "</a>";
            break;

          default:
            $msg .= ( isset( $_POST[ $key ] ) ) ? sanitize_text_field( trim( $_POST[ $key ] ) ) : '-';
            break;

        } // switch

        $msg .= "</td>\r\n";

        $msg .= "</tr>\r\n";

      } // foreach

      $msg .= "</table>\r\n";

      /*  заголовки email */
      $headers = "Content-type: text/html; charset=\"utf-8\" \r\n" .
        "From: " . get_bloginfo( 'admin_email' ) . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

      /*  отправка  */ /**/
      $mailresult = wp_mail(
        get_bloginfo( 'admin_email' ),
        __( 'Подвідомлення з сайту', '' ) . " " . get_bloginfo( 'name' ),
        $msg,
        $headers
      );

      /*  результат */
      if ( $mailresult ) {
        echo '<div class="alert alert-success">' . __( 'Повідомлення відправлено.', 'events-theme' ) . '<br>' . __( 'Ми з Вами обов`зково зв`яжемось.', 'pstu-plugin' ) . '</div>';
      } else {
        echo '<div class="alert alert-danger">'. __( 'Сталася помилка, повідомлення не відправлено!', 'events-theme' ) . '</div>';
      }

    } // if isset $_POST ?>

    <p class="text-center">
      <a class="btn btn-success" href="<?php echo home_url(); ?>"><i class="glyphicon glyphicon-home"></i> <?php _e( 'На головну', 'events-theme' ); ?></a>
      <button class="btn btn-info" type="button" data-toggle="modal" data-target="#error404modal"><i class="glyphicon glyphicon-envelope"></i> <?php _e( 'Зв\'язатись з адміністрацією сайту', 'events-theme' ); ?></button>
    </p>
    <div class="modal fade" id="error404modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php _e( 'Зв\'язок з адміністрацією сайту', 'events-theme' ); ?></h4>
          </div>
          <div class="modal-body">

            <!-- Форма обратной связи -->
            <form class="error404__form form" action="#" method="post">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="error404-user"><?php _e( 'Ваше ім`я', 'events-theme' ); ?></label>
                    <div class="input-group"><span class="input-group-addon" id="error404-addon-user"><i class="glyphicon glyphicon-user"></i></span>
                      <input class="form-control" id="error404-user" type="text" name="username" placeholder="Name" aria-describedby="error404-addon-user">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="error404-email"><?php _e( 'Ваш email', 'events-theme' ); ?></label>
                    <div class="input-group"><span class="input-group-addon" id="error404-addon-email"><i class="glyphicon glyphicon-envelope"></i></span>
                      <input class="form-control" id="error404-email" type="email" name="email" placeholder="email@example.com" aria-describedby="error404-addon-email">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="error404-phone"><?php _e( 'Ваш телефон', 'events-theme' ); ?></label>
                    <div class="input-group"><span class="input-group-addon" id="error404-addon-phone"><i class="glyphicon glyphicon-earphone"></i></span>
                      <input class="form-control" id="error404-phone" type="text" name="phone" placeholder="+3 XXX XXX-XX-XX" aria-describedby="error404-addon-phone">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="alert alert-info alert-sm" role="alert">
                    <i class="glyphicon glyphicon-link"></i>
                    <b>URL:</b>&nbsp;
                    <script type="text/javascript">
                      document.write( window.location.toString() );
                    </script>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="error404-msg"><i class="glyphicon glyphicon-text-size"></i> <?php _e( 'Повідомлення', 'events-theme' ); ?></label>
                    <textarea class="form-control" id="error404-msg" name="msg" placeholder="communication, piece of information, news, word, note, memorandum, memo, email, posting, tweet, letter, line, missive, report, bulletin, communiqué, dispatch, intelligence, notification, announcement" required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 text-right">
                  <button class="btn btn-default" type="button" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> <?php _e( 'Закрити', 'events-theme' ); ?></button>
                  <button class="btn btn-info" role="button"><i class="glyphicon glyphicon-send"></i> <?php _e( 'Відправити', 'events-theme' ); ?></button>
                </div>
              </div>
            </form>
            <!-- // Форма обратной связи -->

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <?php get_sidebar( '404' ); ?>
  </div> <!-- .col-sm-6 -->

</div> <!-- .row -->
<?php get_footer(); ?>