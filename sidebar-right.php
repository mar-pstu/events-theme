<?php if ( is_active_sidebar( 'side_right' ) ) : ?>
  <!-- #aside Правая колонка -->
  <div class="col-sm-4">
    <aside class="main__aside aside" id="main-aside">

      <?php dynamic_sidebar( 'side_right' ); ?>

    </aside>
  </div>
  <!-- end #aside Правая колонка-->
<?php endif; ?>

  
