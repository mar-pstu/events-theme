<form class="searchform form" id="searchform" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="input-group">
    <input class="form-control" id="s" type="text" value="<?php echo get_search_query(); ?>" name="s">
    <span class="input-group-btn">
      <button class="btn btn-default" id="searchsubmit" type="submit" role="button">
      	<i class="glyphicon glyphicon-search"></i> <?php _e( 'Знайти', 'events-theme' ); ?>
      </button>
    </span>
  </div>
</form>