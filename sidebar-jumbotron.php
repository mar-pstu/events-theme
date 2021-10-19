<?php if ( is_active_sidebar( 'side_jumbotron' ) ) : ?>
  <!-- #jumbotron-aside Сайдбар -->
  <div class="col-sm-4">
    <aside class="jumbotron__aside aside small" id="jumbotron-aside">

      <?php dynamic_sidebar( 'side_jumbotron' ); ?>

    </aside>
  </div>
  <!-- end #jumbotron-aside Сайдбар -->
<?php endif; ?>