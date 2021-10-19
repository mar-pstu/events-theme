<?php if ( is_active_sidebar( 'side_footer' ) ) : ?>
  <!-- #footer-aside Сайдбар -->
  <aside class="footer__aside aside" id="footer-aside">
    <div class="container">
      <div class="row">

      <?php dynamic_sidebar( 'side_footer' ); ?>

      </div>
    </div>
  </aside>
  <!-- end #footer-aside Сайдбар -->
<?php endif; ?>