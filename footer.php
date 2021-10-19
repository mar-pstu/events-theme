          </div> <!-- .container -->
        </div> <!-- .wrap -->
      </main>
      <footer class="footer wrapper__item" id="footer">
        <?php get_sidebar( 'footer' ); ?>
        <div class="footer__menu bg-primary text-center" id="footer-menu">
          <div class="container"> <?php
            wp_nav_menu( array( 
                'theme_location'    => 'footer_menu',
                'fallback_cb'       => '__return_empty_string',
                'container'         => 'ul',
                'menu_id'           => '',
                'menu_class'        => '',
                'depth'             => 0,
              )
            ); ?>
          </div>
        </div>
        <div class="footer__wrapper small" id="footer-wrapper">
          <div class="container">
            <div class="row">
              <div class="col-sm-4 col-sm-push-4">
                <p class="text-center"><?php bloginfo( 'description' ); ?></p>
              </div>
              <div class="col-xs-6 col-sm-4 col-sm-pull-4">
                <p class="text-left"><?php echo '&copy;' . __( 'ПДТУ', 'events-theme' ) . ', ' . date( 'Y' ); ?></p>
              </div>
              <div class="col-xs-6 col-sm-4">
                <p class="text-right">
                  <a class="text-right" href="http://lpp.pstu.edu" title="<?php _e( 'Розробка: Лабораторія програмних продуктів ПДТУ' ); ?>"><?php _e( 'Розробка: ЛПП ПДТУ', 'events-theme' ); ?></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div> <!-- #wrapper -->

    <?php wp_footer(); ?>

  </body>
</html>