<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="wrapper" id="wrapper">
      <header class="wrapper__item header" id="header">
        <!-- навигационная панель-->
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <!-- заголовок сайта и кнопка бургер-->
            <div class="navbar-header">
              <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#topnav" aria-expanded="false"><span class="sr-only"><?php _e( 'Навігація', 'pstu-events' ); ?></span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <?php
              if ( has_custom_logo() ) {
                echo get_custom_logo();
              } else {
                echo "<a class=\"navbar-brand\" href=\"" . ( ( is_multisite() ) ? get_home_url( get_current_blog_id() ) : get_home_url( '/' ) ) . "\">" . get_bloginfo( 'name' ) . "</a>";
              } ?>
            </div>
            <div class="collapse navbar-collapse" id="topnav"> <?php
              wp_nav_menu( array( 
                'theme_location'    => 'header_left_menu',
                'fallback_cb'       => '__return_empty_string',
                'container'         => false,
                'menu_id'           => '',
                'menu_class'        => 'nav navbar-nav',
                'depth'             => 1,
              ) );
              wp_nav_menu( array( 
                'theme_location'    => 'header_right_menu',
                'fallback_cb'       => '__return_empty_string',
                'container'         => false,
                'menu_id'           => '',
                'menu_class'        => 'nav navbar-nav navbar-right',
                'depth'             => 1,
              ) ); ?>
              <!-- форма поиска-->
              <form class="navbar-form navbar-right" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="form-group">
                  <input class="form-control" id="s" type="text" value="<?php echo get_search_query(); ?>" name="s">
                </div>
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> <?php _e( 'Знайти', 'events-theme' ); ?></button>
              </form>
              <!-- end форма поиска-->
            </div>
          </div>
        </nav>
        <!-- end навигационная панель-->
      </header>
      <main class="wrapper__item wrapper__item--main main" id="main">
        
        <?php

        // "Первый экран"
        if ( is_front_page() ) { ?>
          <!-- jumbotron-->
          <div data-parallax="scroll" data-image-src="<?php echo ( has_header_image() ) ? get_header_image() : EVENTS_THEME_URL . 'images/jumbotron-bg-1.jpg'; ?>">
            <div class="container">
              <div class="row">
                <div class="<?php echo ( is_active_sidebar( 'side_jumbotron' ) ) ? 'col-sm-8' : 'col-xs-12'; ?>">
                  <div class="jumbotron" id="jumbotron">
                    <h1 class="site__title" id="site-title"><?php bloginfo( 'name' ); ?></h1>
                    <p class="site__description" id="site-description"><?php bloginfo( 'description' ); ?></p>
                  </div>
                </div>
                <?php get_sidebar( 'jumbotron' ); ?>
              </div>
            </div>
          </div>
          <!-- end jumbotron--> <?php
        } elseif ( ! is_404() ) { ?>
          <div class="container">
            <div class="row">
              <div class="page-header">
                <div class="col-sm-8">
                  <h1> <?php
                    if ( is_tag() ) {
                      _e( 'Ви переглядаєте сторінку мітки:', 'events-theme' );
                      single_tag_title( ' <small>', '</small>' );
                    } elseif ( is_category() ) {
                      _e( 'Ви переглядаєте розділ:', 'events-theme' );
                      single_term_title( ' <small>', '</small>' );
                    } elseif ( is_archive() ) {
                      the_archive_title( '' );
                    } elseif ( is_page() ) {
                      single_post_title( '' );
                    } elseif ( is_single() ) {
                      single_post_title( '' );
                      echo " <small>" . get_the_date( "Y/m/d", get_the_ID() ) . "</small>";
                    } elseif ( is_search() ) {
                      _e( 'Результати пошуку:', 'events-theme' );
                      echo " <small>" . get_search_query() . "</small>";
                    } ?>
                  </h1>
                </div>
                <div class="col-sm-4">
                  <?php if ( get_theme_mod( 'header_share_flag', false ) ) : ?>
                    <div class="share-box text-right">
                      <script src="http://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                      <script src="http://yastatic.net/share2/share.js"></script>
                      <div class="share">
                        <div class="ya-share2" data-services="facebook,gplus,twitter,linkedin,pocket,viber,whatsapp"></div>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div> <?php
        } ?>

        <!-- хлебные крошки (#breadcrumb)-->
        <div class="bg-primary">
          <div class="container">
            <ol class="breadcrumb" id="bredcrumbs">
              <?php the_breadcrumb(); ?>
            </ol>
          </div>
        </div>
        <!-- end хлебные крошки (#breadcrumb)-->

        <div class="wrap">
          <div class="container">