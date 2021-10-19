<?php

/**
 * Template Name: Контакты
 */

get_header();

echo "<div class=\"row\">\r\n";

get_sidebar( 'contacts' );

echo "<div class=\"" . ( ( is_active_sidebar( 'side_contacts' ) ) ? 'col-sm-7 col-sm-pull-5' : 'col-xs-12' ) . "\">\r\n";

if ( have_posts() ) {

	while ( have_posts() ) {

		the_post();		

		extract( eventsThemeContactMetaboxClass::get_meta( get_the_ID() ) );

		if ( empty( $form ) ) {

			// обрабатываем форму
			if ( isset( $_POST[ 'msg' ] ) ) {

			  $fields = array(
			    'username'  => __( 'Від кого', 'events-theme' ),
			    'email'     => __( 'Email', 'events-theme' ),
			    'phone'     => __( 'Телефон', 'events-theme' ),
			    'site'      => __( 'Сайт / сторінка', 'events-theme' ),
			    'msg'       => __( 'Повідомлення', 'events-theme' ),
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
			  if ($mailresult) {
			    echo '<div class="alert alert-success">' . __( 'Повідомлення відправлено.', 'events-theme' ) . '<br>' . __( 'Ми з Вами обов`зково зв`яжемось.', 'pstu-plugin' ) . '</div>';
			  } else {
			    echo '<div class="alert alert-danger">'. __( 'Сталася помилка, повідомлення не відправлено!', 'events-theme' ) . '</div>';
			  }

			} // if ?>

			<form class="form events-ajax-forms" action="<?php echo get_permalink( $post->ID ); ?>" method="post">
			  <div class="row">
			    <div class="col-sm-6">
			      <div class="form-group">
			        <label for="contacts-user"><?php _e( 'Ваше им\'я', 'events-theme' ); ?></label>
			        <div class="input-group"><span class="input-group-addon" id="contacts-addon-user"><i class="glyphicon glyphicon-user"></i></span>
			          <input class="form-control" id="contacts-user" type="text" name="username" placeholder="Name" aria-describedby="contacts-addon-user">
			        </div>
			      </div>
			    </div>
			    <div class="col-sm-6">
			      <div class="form-group">
			        <label for="contacts-email"><?php _e( 'Ваш email', 'events-theme' ); ?></label>
			        <div class="input-group"><span class="input-group-addon" id="contacts-addon-email"><i class="glyphicon glyphicon-envelope"></i></span>
			          <input class="form-control" id="contacts-email" type="email" name="email" placeholder="email@example.com" aria-describedby="contacts-addon-email">
			        </div>
			      </div>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
			      <div class="form-group">
			        <label for="contacts-phone"><?php _e( 'Ваш телефон', 'events-theme' ); ?></label>
			        <div class="input-group"><span class="input-group-addon" id="contacts-addon-phone"><i class="glyphicon glyphicon-earphone"></i></span>
			          <input class="form-control" id="contacts-phone" type="text" name="phone" placeholder="+3 XXX XXX-XX-XX" aria-describedby="contacts-addon-phone">
			        </div>
			      </div>
			    </div>
			    <div class="col-sm-6">
			      <div class="form-group">
			        <label for="contacts-site"><?php _e( 'Сайт', 'events-theme' ); ?></label>
			        <div class="input-group"><span class="input-group-addon" id="contacts-addon-site"><i class="glyphicon glyphicon-globe"></i></span>
			          <input class="form-control" id="contacts-site" type="text" name="site" placeholder="http://example.com" aria-describedby="contacts-addon-site">
			        </div>
			      </div>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-xs-12">
			      <div class="form-group">
			        <label for="contacts-msg"><i class="glyphicon glyphicon-text-size"></i> <?php _e( 'Сообщение', 'events-theme' ); ?></label>
			        <textarea class="form-control" id="contacts-msg" name="msg" placeholder="communication, piece of information, news, word, note, memorandum, memo, email, posting, tweet, letter, line, missive, report, bulletin, communiqué, dispatch, intelligence, notification, announcement" required></textarea>
			      </div>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-xs-12">
			      <div class="form-result"></div>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-xs-6 text-left">
			      <button class="btn btn-default" role="button" type="reset"><i class="glyphicon glyphicon-remove"></i> <?php _e( 'Очистити', 'events-theme' ); ?></button>
			    </div>
			    <div class="col-xs-6 text-right">
			      <button class="btn btn-info" role="button" type="submit"><i class="glyphicon glyphicon-send"></i> <?php _e( 'Відправити', 'events-theme' ); ?></button>
			    </div>
			  </div>
			</form>
			<hr> <?php

		} else {
			echo do_shortcode( $form );
		}

		if ( ! empty( $map ) ) {
			echo "<div class=\"panel panel-default\">\r\n";
		  echo "<div class=\"panel-heading\">" . $address . "</div>\r\n";
		  echo "<div class=\"panel-body\">\r\n";
		  echo "<div class=\"embed-responsive embed-responsive-16by9\">\r\n";
		  echo wp_specialchars_decode( $map, ENT_QUOTES );
		  echo "</div>\r\n"; // embed-responsive
		  echo "</div>\r\n"; // panel-body
		 	echo "</div>\r\n"; // panel
		} elseif ( ! empty( $address ) ) {
			echo "<div class=\"well\">\r\n";
			echo $address;
			echo "</div>\r\n";
		}

		// вывод кнтента страницы
		echo "<div class=\"content clearfix\">\r\n";
		the_content();
		echo "</div>\r\n";
		echo "<hr>";

	} // while

} // if

if ( comments_open( $post->ID ) ) comments_template();

echo "</div>\r\n"; // .col-

echo "</div>\r\n"; // .row

get_footer();

?>